<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

        public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Delete the old avatar from storage
        if ($request->user()->avatar) {
            Storage::delete($request->user()->avatar);
        }

        // Upload the new avatar
        $avatarPath = $request->file('avatar')->store('avatars');

        // Update the user's avatar path in the database
        $request->user()->update(['avatar' => $avatarPath]);
    }

    public function show()
    {
        $user = auth()->user();
        $posts = $user->posts; // presupunând că avem o relație 'posts' în modelul User

        return view('profil.index', compact('user', 'posts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = User::where('username', 'LIKE', "%$query%")
            ->orWhere('name', 'LIKE', "%$query%")
            ->get();

        $searchResultsHtml = view('administrator.search_results', ['users' => $users])->render();
        
        return response()->json(['html' => $searchResultsHtml]);
    }

}
