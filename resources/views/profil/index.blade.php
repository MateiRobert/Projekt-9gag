@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">

    <div class="flex items-center justify-between border-b-2 pb-4 mb-6">
        <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full">
        
        <div class="text-center">
            <h2 class="text-2xl font-bold text-indigo-700">{{ $user->username }}</h2>
            <p class="text-gray-500">{{ $user->name }}</p>
        </div>

        <div class="text-center">
            <p class="text-2xl text-indigo-700">{{ $user->posts->count() }}</p>
            <p class="text-gray-500">postări</p>
        </div>
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
