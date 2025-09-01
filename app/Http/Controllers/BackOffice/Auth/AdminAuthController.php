<?php

namespace App\Http\Controllers\BackOffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user->load(['roles', 'direction', 'service']);
            
            return response()->json([
                'success' => true,
                'message' => 'Connexion réussie',
                'user' => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Identifiants incorrects',
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie',
        ]);
    }

    public function checkAuth(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'authenticated' => true,
                'user' => Auth::user()->load(['roles', 'direction', 'service']),
            ]);
        }

        return response()->json([
            'authenticated' => false,
        ]);
    }

    public function user(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->load(['roles', 'direction', 'service']);
            
            return response()->json([
                'success' => true,
                'data' => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Non authentifié',
        ], 401);
    }
}