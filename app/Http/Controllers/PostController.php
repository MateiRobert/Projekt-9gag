<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Report;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    // Display a listing of the posts

    
    public function index(Request $request)
{
    $search = $request->get('search');
    $categoryFilter = $request->get('category');

    $query = Post::query();

    if ($search) {
        $query->where('title', 'LIKE', '%' . $search . '%')
              ->orWhereHas('tags', function ($query) use ($search) {
                  $query->where('name', 'LIKE', '%' . $search . '%');
              });
    }

    // Filter by selected category
    if ($categoryFilter) {
        $query->where('category_id', $categoryFilter);
    }

    $posts = $query->orderBy('created_at', 'desc')->get();
    $categories = Category::all();  // Fetch all categories

    return view('posts.index', ['posts' => $posts, 'categories' => $categories]);
}



    

    // Show the form for creating a new post
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);


    }


    // Store a newly created post in the database
    public function store(Request $request)
    {
        try{
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|mimes:jpeg,png,gif|max:5120', // 5MB
        ]);

        $data['category_id'] = $request->input('category_id');


        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            $path = $request->user()->username . '/' . $filename;
            Storage::disk('public')->put('posts/' . $path, File::get($image));
            
            $data['image_path'] = $path;
            }

            $post = Post::create($data + ['user_id' => $request->user()->id]);

            // Attach tags to the post
            // Parse the tags from the form input
            $tagNames = explode(',', $request->input('tags'));
            $tagIds = [];

            foreach ($tagNames as $tagName) {
                // Trim whitespace and make sure it's not empty
                $tagName = trim($tagName);
                if (!$tagName) continue;

                // Find the tag by name or create a new one
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }

            // Now attach/detach/sync the tags with the post
            $post->tags()->sync($tagIds);

            
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
        $categories = Category::all();
        return view('posts.edit', ['post' => $post, 'categories' => $categories]);



    }


    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $data['category_id'] = $request->input('category_id');


        $post->update($data);
            // Update tags
        // Parse the tags from the form input
        $tagNames = explode(',', $request->input('tags'));
        $tagIds = [];

        foreach ($tagNames as $tagName) {
            // Trim whitespace and make sure it's not empty
            $tagName = trim($tagName);
            if (!$tagName) continue;

            // Find the tag by name or create a new one
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        // Now attach/detach/sync the tags with the post
        $post->tags()->sync($tagIds);


        
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

    
        public function report(Request $request, $postId)
    {
        $post = Post::find($postId);
        
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
        
        // Verifică dacă utilizatorul curent a raportat deja postarea
        $existingReport = Report::where('post_id', $postId)
                                ->where('reported_by', Auth::id())
                                ->first();
                                
        if ($existingReport) {
            return redirect()->back()->with('error', 'You already reported this post.');
        }
        $report = new Report();
        $report->post_id = $postId;
        $report->reported_by = Auth::id();
        $report->post_owner = $post->user_id;
        $report->reason = $request->report_reason;
        $report->save();

        return redirect()->back()->with('success', 'Report submitted.');
    }
}
