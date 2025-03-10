<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Afficher le formulaire de demande de réinitialisation du mot de passe
     */
    public function create()
    {
        return view('auth.passwords.email'); // Vue standard
    }
    
    /**
     * Envoyer le lien de réinitialisation du mot de passe pour un user
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Détecter si l'email appartient à un utilisateur
        $type = $this->detectUserType($request->email);

        if (!$type) {
            return back()->withErrors(['email' => 'Adresse email introuvable.']);
        }

        // Obtenir le broker correspondant (ici, "users")
        $broker = $this->getPasswordBroker($type);

        // Générer et envoyer le lien de réinitialisation de mot de passe
        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }


    /**
     * Détecter le type d'utilisateur en recherchant dans la table users.
     */
    protected function detectUserType($email)
    {
        $user = User::where('email', $email)->first();
        return $user ? 'user' : false;
    }

    /**
     * Retourne le broker correspondant au type d'utilisateur.
     * Pour les users, c'est le broker "users" défini dans config/auth.php.
     */
    protected function getPasswordBroker($type)
    {
        if ($type === 'user') {
            return 'users';
        }
        return null;
    }

    /**
     * Afficher le formulaire de réinitialisation du mot de passe
     */
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    /**
     * Réinitialiser le mot de passe du user
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required', 'string', 'min:8',
                'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/',
                'confirmed',
            ],
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
