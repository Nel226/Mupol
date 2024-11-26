<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AdherantAuthenticatedSessionController;
use App\Http\Controllers\Auth\PartenaireAuthenticatedSessionController;
use App\Http\Requests\Auth\LoginRequest;

class UserLoginDetectorController extends Controller
{
    /**
     * Afficher la vue de connexion.
     */
    public function showLoginForm()
    {
        return view('pages.frontend.all_users.auth.connexion');
    }

    /**
     * Authentifier l'utilisateur et appeler le contrôleur approprié.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Essayer de se connecter en tant qu'adhérent
        if (Auth::guard('adherent')->attempt($credentials)) {
            $request->session()->regenerate();
            // Appel dynamique du contrôleur d'adhérent
            return $this->resolveControllerBasedOnGuard('adherent', $request);
        }

        // Essayer de se connecter en tant que partenaire
        if (Auth::guard('partenaire')->attempt($credentials)) {
            $request->session()->regenerate();
            // Appel dynamique du contrôleur de partenaire
            return $this->resolveControllerBasedOnGuard('partenaire', $request);
        }

        // Si l'authentification échoue
        return back()->withErrors(['email' => 'Les informations d\'identification sont incorrectes.']);
    }

    /**
     * Résoudre dynamiquement le contrôleur basé sur le guard.
     */
    private function resolveControllerBasedOnGuard($guard, Request $request)
    {
        // Sélectionner le contrôleur en fonction du guard
        $controller = match ($guard) {
            'adherent' => AdherentAuthenticatedSessionController::class,
            'partenaire' => PartenaireAuthenticatedSessionController::class,
            default => throw new \Exception("Contrôleur non défini pour ce guard"),
        };

        // Créez une instance de LoginRequest à partir de la requête actuelle
        $loginRequest = LoginRequest::createFrom($request);

        // Injectez le conteneur dans la requête pour éviter l'erreur
        $loginRequest->setContainer(app())->validateResolved();

        // Appelez dynamiquement la méthode store
        return app($controller)->store($loginRequest);
    }
}
