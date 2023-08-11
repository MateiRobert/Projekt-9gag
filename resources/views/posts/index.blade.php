@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="flex bg-white rounded-lg p-4 mb-4 mx-auto relative" style="max-width: 85%; width: 45%; height: 760px;"> 
            <div class="flex-shrink-0 mr-3">
               <img src="{{ asset('storage/' . $post->user->avatar_path) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
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
                        <!-- Setarea dimensiunilor maxime ale imaginii -->
                        <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full max-h-[32.5rem] object-cover w-full rounded-lg shadow-lg">
                    </a>
                </div>
            </div>
            <!-- Poziționarea butoanelor în partea de jos a cardului -->
            <div class="absolute bottom-4 left-4 flex items-center space-x-4">
                <!-- Butoane de votare și comentarii -->
                <button class="p-2 focus:outline-none hover:bg-blue-100" id="upvote-{{ $post->id }}">
                    <svg class="w-8 h-8 text-gray-400 fill-current" viewBox="0 0 24 24">
                        <path d="M7 14l5-5 5 5z"></path>
                    </svg>
                </button>
                <button class="p-2 focus:outline-none hover:bg-red-100" id="downvote-{{ $post->id }}">
                    <svg class="w-8 h-8 text-gray-400 fill-current" viewBox="0 0 24 24">
                        <path d="M7 10l5 5 5-5z"></path>
                    </svg>
                </button>
                <button class="p-2 focus:outline-none hover:bg-gray-100">
                    <svg class="w-8 h-8 text-gray-400 fill-current" viewBox="0 0 24 24">
                        <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"></path>
                    </svg>
                </button>
            </div>

            <!-- Buton de raportare în partea dreaptă jos -->
            <div class="absolute bottom-4 right-4">
                <button class="p-2 focus:outline-none hover:bg-gray-200 transition-colors">
                    <svg class="w-8 h-8 text-gray-400 fill-current hover:text-red-500" viewBox="0 0 24 24">
                        <path d="M2,21.5 L2,16 L22,16 L22,21.5 L2,21.5 Z M2,4 L2,9.5 L22,9.5 L22,4 L2,4 Z"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
</div>
@endsection
