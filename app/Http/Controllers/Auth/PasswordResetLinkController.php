<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\ResetPasswordMail; // Ajoutez l'import de votre Mailable
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.passwords.email'); // Vue standard
    }
    public function store(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        // Détecter le type en fonction de l'email
        $type = $this->detectUserType($request->email);

        if (!$type) {
            return back()->withErrors(['email' => 'Adresse email introuvable.']);
        }

        // Obtenir le broker correspondant au type
        $broker = $this->getPasswordBroker($type);

        // Envoyer le lien de réinitialisation
        $status = Password::broker($broker)->sendResetLink(
            $request->only('email'),
            function ($user, $token) use ($type) {
                // Envoyer un email personnalisé avec le lien de réinitialisation
                Mail::to($user->email)->send(new ResetPasswordMail($token, $type));
            }
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    private function detectUserType($email)
    {
        // Détection du type en fonction des données de votre application
        if (\App\Models\Adherent::where('email', $email)->exists()) {
            return 'adherent';
        }

        if (\App\Models\Partenaire::where('email', $email)->exists()) {
            return 'partenaire';
        }

        return null; // Aucun utilisateur trouvé
    }

    private function getPasswordBroker($type)
    {
        return match ($type) {
            'adherent' => 'adherents',
            'partenaire' => 'partenaires',
            default => 'users',
        };
    }
}
