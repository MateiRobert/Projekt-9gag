@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div> / </div>
        <div class="flex bg-white rounded-lg p-4 mb-4 mx-auto" style="max-width: 85%; width: 45%; height: 760px;"> 
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
                <div class="flex justify-center my-4">
                    <a href="{{ route('posts.show', $post) }}">
                        <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full h-auto" style=" height:85%; width:90%"> 
                    </a>
                </div>
                
            </div>
        </div>
    @endforeach
</div>
@endsection
