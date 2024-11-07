<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Assurez-vous que ce request est correct
use App\Models\Adherant; // Modèle d'adhérent
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;


class AdherantAuthenticatedSessionController extends Controller
{
    /**
     * Afficher la vue de connexion pour les adhérents.
     */
    public function create(): View
    {
        return view('pages.frontend.adherents.auth.connexion', );
    }

    /**
     * Gérer une demande d'authentification entrante.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifier l'utilisateur avec le bon guard
        if (Auth::guard('adherent')->attempt($request->only('email', 'password'))) {
            // Si l'utilisateur est authentifié, régénérer la session
            $request->session()->regenerate();
            return redirect()->route('adherents.dashboard');
        } else {
            // Débogage : vérifier si l'utilisateur existe
            $user = Adherant::where('email', $request->email)->first();
    
            if ($user) {
                // Si l'utilisateur est trouvé, vérifier le mot de passe
                if (Hash::check($request->password, $user->password)) {
                    dd("Le mot de passe correspond bien, mais il y a un problème avec l'authentification.");
                } else {
                    dd("L'utilisateur existe, mais le mot de passe ne correspond pas.");
                }
            } else {
                dd("Aucun utilisateur trouvé avec cet email.");
            }
        }
    
return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }



    public function dashboard(): View
    {
        return view('pages.frontend.adherents.dashboard');
    }


    /**
     * Détruire une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('adherent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login/adherent');
    }
}
