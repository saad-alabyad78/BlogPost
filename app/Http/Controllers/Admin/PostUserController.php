<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostUserController extends Controller
{
    public function create(Post $post , User $user)
    {
        //TODO: user is not admin 
        //TODO: user must not be already attached with the post 
        
        $post->users()->attach($user->id);

        return redirect()->back()->with('success', 'User added to post successfully.');
    }

    public function destroy(Post $post , User $user)
    {
        $post->users()->detach($user->id);

        return redirect()->back()->with('success', 'User removed from post successfully.');
    }
}
