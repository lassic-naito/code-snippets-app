<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagCheckController extends Controller
{
    public function store(Request $request, $id)
    {
        $post = Post::find($id);
        $post->put_tag($id);    
    }
    
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->out_tag($id);    
    }
}
