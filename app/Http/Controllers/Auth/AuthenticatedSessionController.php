<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   /**
 * Handle an incoming authentication request.
 */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Verifică dacă contul utilizatorului este activ
        $user = Auth::user();
        if (!$user->is_active) {
            Auth::logout();  // Deconectează utilizatorul
            
            // Redirecționează înapoi la formularul de login cu un mesaj de eroare
            return redirect()->route('login')->withErrors(['email' => 'Contul este blocat.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/posts');
    }
}
