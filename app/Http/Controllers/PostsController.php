<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $key_category = $request->input('key_category');
        
        $query = Post::query();
        $category = new Category();

        // $request->session()->put('session_key', $key_category);

        if(!empty($keyword))
        {
            $query->where('title','like',$keyword)
                ->orWhere('content','like',$keyword);
                // ->where('category_id', 'session_key');
        }
        
        if(!empty($key_category))
        {
            $query->where('category_id', $key_category);
            // $request->session()->forget('session_key');
        }
        
        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('id','asc')->get();
        
        $category_name = $category->where('id',$key_category)->value('name');
        
        $data = [
            'posts' => $posts,
            'categories' => $categories,
            'keyword' => $keyword,
            'category_name' => $category_name,
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

        return view('posts.create', [
            'post' => $post,
            'categories' => $categories,
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
}
