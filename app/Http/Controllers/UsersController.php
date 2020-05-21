<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $data =[];
        
        if(\Auth::check()){
            $user = \Auth::user();
    
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }
        return view('users.index', $data);
    }
    
    public function edit()
    {
        $user = \Auth::user();

        return view('users.index',[ 'user' => $user ]);
    }
    
    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required',
    //     ]);
        
    //     $user = User::find($id);

    //     return redirect('/user');   
    // }
    
    public function deleteData($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect('/');
    }
}
