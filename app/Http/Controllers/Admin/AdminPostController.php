<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Enums\MediaTypes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('users')->paginate(10);
        return view('admin.home', compact('posts'));
    }

    public function showUsers(Post $post)
    {     
        return view('admin.postUsers' , ['post'=>$post,'users'=>$post->users()->get()]) ;
    }
    

    public function destroyPost(Post $post)
    {

        $post->delete();
        return redirect()->route('admin.home')->with('success', 'Post deleted successfully.');
    }

}
