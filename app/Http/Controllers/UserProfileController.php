<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    //


    public function show(User $user)
    {

        $user = User::findOrFail($user->id);
        $posts = $user->posts;




        return view('profil.show', compact('user', 'posts'));
    }




}
