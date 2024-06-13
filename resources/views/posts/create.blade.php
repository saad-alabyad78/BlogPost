@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>bad title</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>bad desctiption</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="media_url">Media Url</label>
            <input type="url" class="form-control" id="media_url" name="media_url">
            @error('media_url')
                <span class="invalid-feedback" role="alert">
                    <strong>bad media url</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="media_type">Media Type</label>
            <input type="text" class="form-control" id="media_type" name="media_type">
            @error('media_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{bad media type</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
