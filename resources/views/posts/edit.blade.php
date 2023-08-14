@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="flex flex-col md:flex-row bg-white rounded-lg p-4 mx-auto" style="max-width: 85%; width: 100%;">

        <!-- Image of the post -->
        <div class="flex-shrink-0">
            <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full object-cover rounded-lg shadow-lg" style="width: 500px; height: auto;">
        </div>

        <!-- Post edit form -->
        <div class="flex-grow p-4" style="max-width: 60%;">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" required class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-md">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="tags" id="tags" value="{{ implode(',', $post->tags->pluck('name')->toArray()) }}" placeholder="Enter tags separated by commas" class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Update button -->
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg">Update Post</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
