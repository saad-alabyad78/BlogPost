@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $post->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="url" class="form-control" id="image_url" name="image_url" value="{{ $post->image_url }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
