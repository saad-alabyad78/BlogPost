@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
    <img src="{{ $post->image_url }}" alt="{{ $post->title }}">
    @can('update', $post)
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary">Update</a>
    @endcan
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    @endcan
</div>
@endsection
