@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex items-center px-4 sm:px-0">
        <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
        <div class="ml-6">
            <div class="text-center">
                <p class="text 2xl font-bold text-indigo-700">{{ $user->name }}</p>
                <hr class="my-2">
                <pre class="text-gray-500">{{ $user->description }}</pre>
            </div>

            
        </div>

    <div class= "mx-auto py-8">
        @if(auth()->check())
    @if (auth()->user()->isNot($user))
        @if(auth()->user()->isFollowing($user->id))
            <form action="/unfollow/{{ $user->id }}" method="post" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                    Unfollow
                </button>
            </form>
        @else
            <form action="/follow/{{ $user->id }}" method="post" class="mt-2">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Follow
                </button>
            </form>
        @endif
    @endif
@endif

    </div>


        
        <div class="ml-auto flex items-center space-x-4 justify-between">
    <div class="text-center">
        <p class="text-2xl text-indigo-700">{{ $user->posts->count() }}</p>
        <p class="text-gray-500">Posts</p>
    </div>
    <p class="text-gray-500 ml-2">|</p>
    <div class="text-center ml-2">
        <p class="text-2xl text-indigo-700">{{ $user->posts->count() }}</p>
        <p class="text-gray-500">Followers</p>
    </div>
    <p class="text-gray-500 ml-2">|</p>
    <div class="text-center ml-2">
        <p class="text-2xl text-indigo-700">{{ $user->posts->count() }}</p>
        <p class="text-gray-500">Following</p>
    </div>
</div>

    </div>
    <hr class="my-6">
</div>


    <div class="grid grid-cols-3 gap-4 mt-6">
        @forelse($posts as $post)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#" class="block">
                    <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="w-full h-[20rem] object-cover rounded-t-lg shadow-lg">
                </a>
                <div class="p-5">
                    <a href="#" class="block">
                        <h5 class="mb-2 text-2xl font-bold text-indigo-700 dark:text-white">{{ $post->title }}</h5>
                    </a>
                    <a href="{{ url('/posts/' . $post->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Arată Postarea
                        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center my-4 text-gray-600">
                Nu există postări pentru acest utilizator.
            </div>
        @endforelse
    </div>

</div>
@endsection
