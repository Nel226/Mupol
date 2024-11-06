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
        if (Auth::guard('adherent')->attempt($request->only('email', 'password'))) {
            // Succès de la connexion
            $request->session()->regenerate();
            return redirect()->route('adherents.dashboard');
        } else {
            // Débogage : vérifiez si l'utilisateur existe
            $user = \App\Models\Adherant::where('email', $request->email)->first();

            if ($user) {
                // Utilisateur trouvé, vérifiez le mot de passe
                if (Hash::check($request->password, $user->password)) {
                    dd("Le mot de passe correspond bien, problème avec l'authentification.");
                } else {
                    dd("Utilisateur trouvé, mais le mot de passe ne correspond pas.");
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
