<?php

namespace App\Http\Controllers\Auth;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class PartenaireAuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('pages.frontend.partenaires.auth.connexion', );
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        if (Auth::guard('partenaire')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
    
            $partenaire = Auth::guard('partenaire')->user();
                return redirect()->route('partenaires.dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }

    public function dashboard(): View
    {
        return view('pages.frontend.partenaires.dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('partenaire')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login/partenaire');
    }
    
}
