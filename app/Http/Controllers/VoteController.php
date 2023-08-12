<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function upvote(Post $post)
    {
        $existingVote = $post->votes()->where('user_id', auth()->id())->first();

        if ($existingVote) {
            // Verificăm dacă votul existent este un upvote
            if ($existingVote->value == 1) {
                $existingVote->delete(); // Ștergem votul dacă este deja un upvote
            } else {
                $existingVote->update(['value' => 1]);
            }
        } else {
            $post->votes()->create([
                'user_id' => auth()->id(),
                'value' => 1,
            ]);
        }
        
        return back();
    }

    public function downvote(Post $post)
    {
        $existingVote = $post->votes()->where('user_id', auth()->id())->first();

        if ($existingVote) {
            // Verificăm dacă votul existent este un downvote
            if ($existingVote->value == -1) {
                $existingVote->delete(); // Ștergem votul dacă este deja un downvote
            } else {
                $existingVote->update(['value' => -1]);
            }
        } else {
            $post->votes()->create([
                'user_id' => auth()->id(),
                'value' => -1,
            ]);
        }
        
        return back();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
