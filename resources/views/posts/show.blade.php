@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex bg-white rounded-lg p-4 mx-auto" style="max-width: 45%;">
        <div class="flex-shrink-0 mr-3">
            <img src="{{ $post->user->avatar_path }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
        </div>
        <div class="flex-grow">
            <div class="flex items-center text-gray-600 text-sm">
                <span>{{ $post->user->name }}</span>
                <span class="mx-1">&bull;</span>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
            <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="w-full h-auto my-4 rounded-lg ">
            <p class="text-sm">{{ $post->content }}</p>
        </div>
    </div>
</div>
@endsection
