@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" class="form-control">{{ $post->content }}</textarea>
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
