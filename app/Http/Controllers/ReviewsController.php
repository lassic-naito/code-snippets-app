<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Review;
use App\Post;

class ReviewsController extends Controller
{
    public function store(Request $request)
    {
        // $this->authorize('posts.show');
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required',
            'content' => 'required|max:2000',
        ]);
        
        $post = Post::find($params['post_id']);
        $post->review()->create($params);
        
        // $review = new Review;
        
        // $review->content = $request->content;
        // $review->post_id = $request->post_id;
        // $review->user_id = \Auth::id();
        // $review->save();
        
        return redirect()->route('posts.show', ['post' => $post]);
    }
}
