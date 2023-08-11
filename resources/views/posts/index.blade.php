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

                    @if(auth()->user()->id == $post->user->id || auth()->user()->is_admin)
                        <div class="ml-auto">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button class="focus:outline-none">&#8942;</button>
                                </x-slot>
                                <x-slot name="content">
                                    <a href="{{ route('posts.edit', $post->id) }}" class="block px-4 py-2 text-white hover:bg-indigo-500 hover:text-white">Editează postarea</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-indigo-500 hover:text-white">Șterge postarea</button>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                </div>
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <div class="flex justify-center my-4">
                    <a href="{{ route('posts.show', $post) }}">
                        <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full h-auto" style="height:85%; width:90%; min-width: 100px; min-height: 85%; shadow-lg rounded-lg">
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
