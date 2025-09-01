<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDirection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedDirections): Response
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Non authentifié'], 401);
        }

        $user = Auth::user();
        
        // If user doesn't have a direction, deny access
        if (!$user->direction) {
            return response()->json(['message' => 'Accès refusé - Aucune direction assignée'], 403);
        }

        $userDirectionCode = $user->direction->code;
        
        // Check if user's direction is in allowed directions
        if (!in_array($userDirectionCode, $allowedDirections)) {
            return response()->json(['message' => 'Accès refusé - Direction non autorisée'], 403);
        }

        return $next($request);
    }
}