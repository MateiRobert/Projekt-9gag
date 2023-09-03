<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
   

    // În FollowController.php

    public function follow(User $user)
    {
        if (auth()->user()->isNot($user)) {
            auth()->user()->following()->attach($user->id);
        }
                return back();
    }

    public function unfollow(User $user)
    {
        if (auth()->user()->isNot($user)) {
            auth()->user()->following()->detach($user->id);
        }
        return back();
    }



}
