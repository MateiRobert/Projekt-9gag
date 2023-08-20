@extends('layouts.app')

@section('content')





<div class="container">
    
@if($posts->isEmpty())
    <div class="text-center my-4 text-gray-600">
        Nu există postări pentru termenul de căutare specificat.
    </div>
@endif


@foreach($posts as $post)
        <div class="flex bg-white rounded-lg p-4 mb-4 mx-auto relative" style="max-width: 85%; width: 45%; height: 760px;"> 
            <div class="flex-shrink-0 mr-3">
               <img src="{{ asset('storage/' . $post->user->avatar_path) }}" alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full">
            </div>
            <div class="flex-grow">
                <div class="flex items-center text-gray-600 text-sm">
                    <div> @ </div>
                    <span class="font-bold text-black"> {{ $post->user->name }}</span>
                    <span class="mx-1">&bull;</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>

                        @if(auth()->check() && (auth()->user()->id == $post->user->id || auth()->user()->is_admin))
                        <div class="ml-auto">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button class="text-gray-500 hover:text-gray-600 focus:outline-none">
                                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12 16.495c1.242 0 2.25 1.008 2.25 2.25s-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25 1.008-2.25 2.25-2.25zm0-6.75c1.242 0 2.25 1.008 2.25 2.25s-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25 1.008-2.25 2.25-2.25zm0-6.75c1.242 0 2.25 1.008 2.25 2.25s-1.008 2.25-2.25 2.25-2.25-1.008-2.25-2.25 1.008-2.25 2.25-2.25z"/></svg>                                </x-slot>
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
                <span class="text-gray-500 text-sm ml-2 italic">~ {{ $post->category->name }}</span>
                <hr class="mb-4">
                <h2 class="text-lg font-semibold">{{ $post->title }}</h2>
                <div class="flex justify-center my-4">
                    <a href="{{ route('posts.show', $post) }}">
                        <img src="{{ asset('storage/posts/' . $post->image_path) }}" alt="Post Image" class="max-w-full max-h-[32.5rem] object-cover w-full rounded-lg shadow-lg">
                    </a>
                </div>
            </div>
            
             

            <!-- Tagurile -->
            <div class="absolute bottom-4 left-4 flex items-center space-x-4">
                @foreach($post->tags as $tag)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                @endforeach
            </div>
            
            <div class="absolute bottom-7 left-4 flex items-center space-x-4">
                @php
                $userVote = $post->votes->where('user_id', auth()->id())->first();
                @endphp
                <form action="{{ route('post.upvote', $post->id) }}" method="POST">
                    @csrf
                     <button type="submit" class="p-2 focus:outline-none ">
                    <svg class="w-8 h-8 {{ $userVote && $userVote->value === 1 ? 'text-blue-500 fill-current' : 'text-gray-400' }}" viewBox="0 0 24 24">
                            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m9.001 10.978h-3.251c-.412 0-.75-.335-.75-.752 0-.188.071-.375.206-.518 1.685-1.775 4.692-4.945 6.069-6.396.189-.2.452-.312.725-.312.274 0 .536.112.725.312 1.377 1.451 4.385 4.621 6.068 6.396.136.143.207.33.207.518 0 .417-.337.752-.75.752h-3.251v9.02c0 .531-.47 1.002-1 1.002h-3.998c-.53 0-1-.471-1-1.002zm7.506-1.5-4.507-4.751-4.507 4.751h3.008v10.022h2.998v-10.022z" fill-rule="nonzero"/></svg>
                        </svg>
                    </button>

                </form>
                <span class="text-lg font-semibold">{{ $post->votes->sum('value') }}</span>
                <form action="{{ route('post.downvote', $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 focus:outline-none ">
                        <svg class="w-8 h-8 text-gray-400 {{ $userVote && $userVote->value === -1 ? 'fill-current text-red-500' : '' }}" viewBox="0 0 24 24">
                             <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m9.001 13.022h-3.251c-.412 0-.75.335-.75.752 0 .188.071.375.206.518 1.685 1.775 4.692 4.945 6.069 6.396.189.2.452.312.725.312.274 0 .536-.112.725-.312 1.377-1.451 4.385-4.621 6.068-6.396.136-.143.207-.33.207-.518 0-.417-.337-.752-.75-.752h-3.251v-9.02c0-.531-.47-1.002-1-1.002h-3.998c-.53 0-1 .471-1 1.002zm4.498-8.522v10.022h3.008l-4.507 4.751-4.507-4.751h3.008v-10.022z" fill-rule="nonzero"/></svg>
                        </svg>
                    </button>
                </form>
                
                <button class="p-2 focus:outline-none">
                    <a href="{{ route('posts.show', $post) }}" class="p-2 focus:outline-none ">
                        <svg class="w-8 h-8 text-gray-400 fill-current" viewBox="0 0 24 24">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 1c-6.338 0-12 4.226-12 10.007 0 2.05.739 4.063 2.047 5.625l-1.993 6.368 6.946-3c1.705.439 3.334.641 4.864.641 7.174 0 12.136-4.439 12.136-9.634 0-5.812-5.701-10.007-12-10.007zm0 1c6.065 0 11 4.041 11 9.007 0 4.922-4.787 8.634-11.136 8.634-1.881 0-3.401-.299-4.946-.695l-5.258 2.271 1.505-4.808c-1.308-1.564-2.165-3.128-2.165-5.402 0-4.966 4.935-9.007 11-9.007zm-5 7.5c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5zm5 0c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5zm5 0c.828 0 1.5.672 1.5 1.5s-.672 1.5-1.5 1.5-1.5-.672-1.5-1.5.672-1.5 1.5-1.5z"/></svg>
                        </svg>
                    </a>
                </button>

                

                <span class="text-gray-600 text-sm">{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
           

                <button onclick="openReportModal({{ $post->id }})" class="p-2 focus:outline-none transition-colors">
                    <svg class="w-8 h-8 {{ $post->reported_by_user ? 'text-red-500' : 'text-gray-400' }} fill-current hover:text-red-500" viewBox="0 0 24 24">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 24h-2v-24h2v24zm18-16l-16-6v12l16-6z"/></svg>
                    </svg>
                </button>


            </div>
        </div>
    @endforeach

        <!-- Modal Background -->
    <input type="hidden" name="post_id" id="reportPostId" value="">
    <div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="reportModal">
        <!-- Modal Content -->
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-xl mb-4">Report Post</h2>
            <form action="/report" method="POST">
                @csrf
                <textarea class="w-full p-2 border rounded mb-4" name="report_reason" placeholder="Write your report reason..."></textarea>
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">Submit Report</button>
                <button type="button" class="ml-4 text-gray-500 hover:text-gray-600" onclick="closeReportModal()">Cancel</button>
            </form>
        </div>
    </div>



 

</div>
@endsection
