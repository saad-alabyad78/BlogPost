<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Enums\MediaTypes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10); 
        return view('home', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'media_url' => 'nullable|url',
            'media_type' => Rule::in([MediaTypes::AUDIO , MediaTypes::VIDEO , MediaTypes::IMAGE]) ,
        ]);

        

        $post = new Post([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $request->media_url,
            'media_type' => $request->media_type ,
        ]);

        $post->save();

        auth()->user()->posts()->save($post) ;

        return auth()->user()->posts() ;

        return redirect()->route('home')->with('success', 'Post created successfully');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'image_url' => 'nullable|url',
        ]);

        $post->update($request->all());

        return redirect()->route('home')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }
}
