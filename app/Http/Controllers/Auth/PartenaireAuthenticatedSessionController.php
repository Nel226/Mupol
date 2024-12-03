<?php

namespace App\Http\Controllers\Auth;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
            if ($partenaire->must_change_password) {
                return redirect()->route('partenaire.change-password');
            }
            else{
                return redirect()->route('partenaires.dashboard');
            }
        }
    
        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
            'password' => 'Les informations d\'identification sont incorrectes.',

        ]);

    }

    public function showChangePasswordForm(): View
    {
        return view('pages.frontend.partenaires.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',              
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*?&]/',  
                'confirmed',          
            ],
        ]);

        $partenaire = Auth::guard('partenaire')->user();
        $partenaire->password = Hash::make($request->password);
        $partenaire->must_change_password = false;
        $partenaire->save();

        return redirect()->route('partenaires.dashboard')->with('status', 'Votre mot de passe a été mis à jour avec succès.');
    }
  
    public function dashboard(): View
    {
        $partenaire = Auth::guard('partenaire')->user();
        $pageTitle = 'Profil';

        return view('pages.frontend.partenaires.dashboard', compact('partenaire', 'pageTitle'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('partenaire')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login/user');
    }
    
}
