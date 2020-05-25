<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        
        // キーワード検索
        $keyword = $request->input('keyword');
        
        if(!empty($keyword))
        {
            $query->where('title','like', "%$keyword%")
                ->orWhere('content','like', "%$keyword%");
               // ->where('category_id', 'session_key');
        }
        
        // カテゴリ絞り込み
        $key_category = $request->input('key_category');
        $category = new Category();
        
        if(!empty($key_category))
        {
            $query->where('category_id', $key_category);
            // $request->session()->forget('session_key');
        }
        
        $categories = Category::orderBy('id','asc')->get();
        $category_name = $category->where('id',$key_category)->value('name');
        
        // タグ検索
        $tag = $request->input('tag');
        
        if (!empty($tag)) {
            $query->whereIn('id', $this->getPostIdByTag($tag));
        }
        
        $tag_list = Tag::get()->pluck("name", "id");

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
            'posts' => $posts,
            'categories' => $categories,
            'keyword' => $keyword,
            'category_name' => $category_name,
            'tag_list' => $tag_list,
        ];
        
        return view('welcome', $data);
    }
    
    public function create()
    {
        $post = new Post;
        $categories = Category::orderBy('id','asc')->pluck('name', 'id');
        $tag_list = Tag::pluck("name", "id");
        
        // $tagList = Tag::get()->pluck("name","id");

        return view('posts.create', [
            'post' => $post,
            'categories' => $categories,
            'tag_list' => $tag_list,
        ]);
    }
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'content' => 'required|max:2000',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = \Auth::id();
        $post->save();
        
        $post->tags()->attach($request->input('tags'));

        return redirect('/')->with('flash_message', '投稿が完了しました');;
    }
    
    public function show($id)
    {
        $user = \Auth::user();
        $post = Post::find($id);
        $d_user = User::onlyTrashed()->where('id', $post->user_id)->exists();
        
        return view('posts.show', [
            'user' => $user,
            'post' => $post,
            'd_user' => $d_user,
        ]);
    }
    
    public function edit($id)
    {
        $data = [];
        
        $post = Post::find($id);
        $categories = Category::orderBy('id','asc')->pluck('name', 'id');
        $tag_list = Tag::pluck("name", "id");
        
        if(\Auth::id() !== $post->user_id){
            return redirect('/');
        }
        
        $data = [
            'post' => $post,
            'categories' => $categories,
            'tag_list' => $tag_list,
        ];

        return view('posts.edit', $data);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'content' => 'required|max:2000',
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = \Auth::id();
        $post->save();
        
        $post->tags()->detach();
        $post->tags()->attach($request->input('tags'));

        return redirect()->route('posts.show', ['post' => $post])->with('flash_message', '編集が完了しました');
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        return redirect('/')->with('flash_message', '投稿を削除しました');
    }

    public function getPostIdByTag($tagId)
    {
        $tag = Tag::find($tagId);
        // $tag->post_tag()->where('tag_id', $tagId);

        return $tag->post_tag()->pluck("post_id");
    }
}
