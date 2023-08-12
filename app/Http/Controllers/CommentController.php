<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    

    public function store(Request $request, Post $post){

        $data = $request->validate(['body' => 'required']);
        $data['user_id'] = auth()->id();

        $post->comments()->create($data);

        return back()->with('success', 'Comentariu adăugat cu succes!');
    }


    public function destroy(Post $post, Comment $comment){
        $comment->delete();
        return back()->with('success', 'Comentariu șters cu succes!');
    }

    

}
