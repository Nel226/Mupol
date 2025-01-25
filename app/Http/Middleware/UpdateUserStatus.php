<?php

namespace App\Http\Middleware;

use Closure;
use App\Events\UserStatusChanged;
use Illuminate\Support\Facades\Auth;


class UpdateUserStatus
{
    public function handle($request, Closure $next)
    {
        // Si l'utilisateur est authentifié, nous mettons à jour son statut en ligne
        if (Auth::check()) {
            $user = Auth::user();
            event(new UserStatusChanged($user, 'online')); // Diffuser l'événement en ligne
        }

        // Ajouter un listener pour l'événement de déconnexion
        $response = $next($request);

        // Si l'utilisateur est déconnecté, on s'assure qu'il n'y a pas de $user non défini
        if (Auth::check() === false && isset($user)) {
            event(new UserStatusChanged($user, 'offline')); // Diffuser l'événement hors ligne
        }

        return $response;
    }
}
