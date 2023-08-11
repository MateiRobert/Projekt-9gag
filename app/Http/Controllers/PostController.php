<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }
    

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        try{
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|max:5120', // 5MB max size
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            $path = $request->user()->username . '/' . $filename;
            Storage::disk('public')->put('posts/' . $path, File::get($image));
            
            $data['image_path'] = $path;
            }

        Post::create($data + ['user_id' => $request->user()->id]);
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
            } catch (\Exception $e) {
        return redirect()->back()->with('error', 'There was an error processing your request.');
    }

    }

    // Display the specified post
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'sometimes|image|max:5120',
        ]);

        if ($request->hasFile('image_path')) {
            // Delete the old image
            Storage::disk('public')->delete('posts/' . $post->image_path);

            // Save the new image
            $image = $request->file('image_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            $path = $request->user()->username . '/' . $filename;
            Storage::disk('public')->put('posts/' . $path, File::get($image));
            
            $data['image_path'] = $path;
        }

        $post->update($data);
        
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');

    }

    // Remove the specified post from the database
    public function destroy(Post $post)
    {
        // Delete the associated image
        Storage::disk('public')->delete('posts/' . $post->image_path);

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');

    }
}
