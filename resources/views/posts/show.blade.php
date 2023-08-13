@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex flex-col md:flex-row bg-white rounded-lg p-4 mx-auto" style="max-width: 85%; width: 100%;">

        <!-- Image of the post -->
        <div class="flex-shrink-0">
            <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full object-cover rounded-lg shadow-lg" style="width: 500px; height: auto;">
        </div>

        <!-- Comments and details section -->
        <div class="flex-grow p-4" style="max-width: 60%;">
            <div class="flex items-center mb-4">
                <img src="{{ asset('storage/' . $post->user->avatar_path) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full mr-3">
                <div>@</div>
                <span class="font-semibold">{{ $post->user->name }}</span>
                <span class="text-gray-500 text-sm ml-2 italic">~ {{ $post->category->name }}</span>
                <span class="text-gray-500 ml-2">{{ $post->created_at->diffForHumans() }}</span>

                <div class="flex items-center space-x-4">
                    @php
                        $userVote = auth()->check() ? $post->votes->where('user_id', auth()->id())->first() : null;
                    @endphp

                    <form action="{{ route('post.upvote', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 focus:outline-none hover:bg-blue-100">
                             <svg class="w-8 h-8 text-gray-400 {{ $userVote && $userVote->value === 1 ? 'fill-current text-blue-500' : '' }}" viewBox="0 0 24 24">
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m9.001 10.978h-3.251c-.412 0-.75-.335-.75-.752 0-.188.071-.375.206-.518 1.685-1.775 4.692-4.945 6.069-6.396.189-.2.452-.312.725-.312.274 0 .536.112.725.312 1.377 1.451 4.385 4.621 6.068 6.396.136.143.207.33.207.518 0 .417-.337.752-.75.752h-3.251v9.02c0 .531-.47 1.002-1 1.002h-3.998c-.53 0-1-.471-1-1.002zm7.506-1.5-4.507-4.751-4.507 4.751h3.008v10.022h2.998v-10.022z" fill-rule="nonzero"/></svg>
                        </svg>
                        </button>
                    </form>
                    <span class="text-lg font-semibold">{{ $post->votes->sum('value') }}</span>
                    <form action="{{ route('post.downvote', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 focus:outline-none hover:bg-red-100">
                            <svg class="w-8 h-8 text-gray-400 {{ $userVote && $userVote->value === -1 ? 'fill-current text-red-500' : '' }}" viewBox="0 0 24 24">
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m9.001 13.022h-3.251c-.412 0-.75.335-.75.752 0 .188.071.375.206.518 1.685 1.775 4.692 4.945 6.069 6.396.189.2.452.312.725.312.274 0 .536-.112.725-.312 1.377-1.451 4.385-4.621 6.068-6.396.136-.143.207-.33.207-.518 0-.417-.337-.752-.75-.752h-3.251v-9.02c0-.531-.47-1.002-1-1.002h-3.998c-.53 0-1 .471-1 1.002zm4.498-8.522v10.022h3.008l-4.507 4.751-4.507-4.751h3.008v-10.022z" fill-rule="nonzero"/></svg>
                        </svg>
                            
                        </button>
                    </form>
                </div>

                <!-- Dropdown button -->
                @if(auth()->check() && (auth()->user()->id == $post->user->id || auth()->user()->is_admin))
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

            <!-- Post content -->
            <p class="mb-4">{{ $post->content }}</p>

            <!-- Line separator -->
            <hr class="my-4">

            <!-- Display previous comments -->
            <div class="mb-4">
                @foreach($post->comments as $comment)
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('storage/' . $comment->user->avatar_path) }}" alt="{{ $comment->user->name }}" class="w-6 h-6 rounded-full mr-2">
                        <span class="font-semibold">{{ $comment->user->name }}</span>
                        <p class="ml-2">{{ $comment->body }}</p>
                        @if(auth()->check() && auth()->id() == $comment->user_id)
                            <form action="{{ route('comments.destroy', [$post, $comment]) }}" method="POST" class="ml-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 p-2 rounded hover:bg-red-100">
                                    <svg width="20" height="20" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m12 10.93 5.719-5.72c.146-.146.339-.219.531-.219.404 0 .75.324.75.749 0 .193-.073.385-.219.532l-5.72 5.719 5.719 5.719c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.385-.073-.531-.219l-5.719-5.719-5.719 5.719c-.146.146-.339.219-.531.219-.401 0-.75-.323-.75-.75 0-.192.073-.384.22-.531l5.719-5.719-5.72-5.719c-.146-.147-.219-.339-.219-.532 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Comment input -->
            <div class="border-t pt-4 mt-4">
                @if(auth()->check())
                    <div class="flex">
                        <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full mr-3">
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex-grow">
                            @csrf
                            <textarea name="body" class="w-full bg-gray-100 p-2 rounded-lg"></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-lg">Adaugă comentariu</button>
                        </form>
                    </div>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Atenție!</strong>
                        <span class="block sm:inline">Trebuie să te autentifici pentru a lăsa un comentariu.</span>
                        <a href="{{ route('login') }}" class="underline ml-2">Autentifică-te acum</a>.
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
