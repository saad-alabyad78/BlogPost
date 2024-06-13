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

    public function addUserToPost(Post $post , User $user)
    {
        //TODO: user is not admin 
        $post->users()->attach($user->id);

        return redirect()->route('admin.home')->with('success', 'User added to post successfully.');
    }

    public function removeUserFromPost(Post $post , User $user)
    {
        $post->users()->detach($user->id);

        return redirect()->route('admin.home')->with('success', 'User removed from post successfully.');
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.home')->with('success', 'Post deleted successfully.');
    }
}
