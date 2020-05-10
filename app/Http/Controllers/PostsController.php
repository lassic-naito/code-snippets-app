<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('id','asc')->get();
            
        $data = [
            'posts' => $posts,
            'categories' => $categories,
        ];
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191',
            'content' => 'required|max:191',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = \Auth::id();
        $post->save();


        return back();
    }
    
    public function show()
    {
        $post = Post::find($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
    
    public function create()
    {
        $post = new Post;
        $categories = Category::orderBy('id','asc')->pluck('category_name');

        return view('posts.create', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }
    
    public function destroy($id)
    {
        $post = \App\Post::find($id);

        if (\Auth::id() === $post->user_id) {
            $post->delete();
        }

        return back();
    }
}
