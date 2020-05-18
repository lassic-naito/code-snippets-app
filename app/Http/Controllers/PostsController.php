<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use App\PostTag;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        
        // キーワード検索
        $keyword = $request->input('keyword');
        
        if(!empty($keyword))
        {
            $query->where('title','like',$keyword)
                ->orWhere('content','like',$keyword);
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
        $tags = \Request::get('tag');
     
        if ($tags) {
            $query->whereIn('id', $this->getPostIdByTags($tags));
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
        $post->tag()->attach($request->input('tags'));

        return redirect('/');
    }
    
    public function show($id)
    {
        $user = \Auth::user();
        $post = Post::find($id);

        return view('posts.show', [
            'user' => $user,
            'post' => $post,
        ]);
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
    
    public function destroy($id)
    {
        $post = Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        return redirect('/');
    }

    // public function getPostIdByKeywords($req)
    // {
            
    // }
    
    
    public function getPostIdByTags($tags)
    {
        $query = PostTag::query();
        if ($query !== null){
            foreach($tags as $id){
                $query->Where('tag_id', $id);
            }
        }
        
        return $query->get()->pluck("post_id");
    }
}
