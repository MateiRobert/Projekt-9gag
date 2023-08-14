@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white shadow-md rounded-lg overflow-hidden max-w-md mx-auto mt-4">
        <div class="bg-gray-100 p-4 font-semibold text-lg">
            Create Post
        </div>
        <div class="p-4">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id" class="mt-1 p-2 w-full border rounded-md" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="image_path" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" name="image_path" id="image_path" class="mt-1" required>
                </div>

                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <input type="text" name="tags" id="tags" placeholder="Enter tags separated by commas" class="mt-1 p-2 w-full border rounded-md">
                </div>



                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                    Post
                </button>
                
            </form>
        </div>
    </div>
</div>
@endsection
