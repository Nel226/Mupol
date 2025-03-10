<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    // Afficher le formulaire de demande de réinitialisation
    public function showForgotPasswordForm()
    {
        return view('pages.frontend.all_users.auth.passwords.email');
    }

    // Envoi du lien de réinitialisation du mot de passe
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('adherents')->where('email', $value)->exists()
                        || DB::table('partenaires')->where('email', $value)->exists();

                    if (!$exists) {
                        $fail("L'email fourni n'existe pas.");
                    }
                },
            ],
        ]);

        $userType = DB::table('adherents')->where('email', $request->email)->exists() ? 'adherent' : 'partenaire';

        // Générer un token
        $token = Str::random(60);
        $expiresAt = now()->addMinutes(60); // expiration dans 60 minutes

        DB::table('password_resets_adherents_partenaires')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'user_type' => $userType, 'created_at' => now(), 'expires_at' => $expiresAt]
        );
       
        // Envoyer l'email avec le token non haché
        Mail::to($request->email)->send(new ResetPasswordMail(urlencode($token), $request->email, $userType));

        return back()->with('status', 'Email de réinitialisation envoyé !');
    }

    // Affichage du formulaire de réinitialisation
    public function showResetForm($token)
    {
        
        return view('pages.frontend.all_users.auth.passwords.reset', ['token' => $token]);
    }

    // Réinitialisation du mot de passe
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
        
        // Vérifier si l'email est présent et si le token est valide
        $record = DB::table('password_resets_adherents_partenaires')
                ->where('email', $request->email)
                ->first();

        // Vérification du token
        if (!$record || urldecode($request->token) !== $record->token || (now()->timestamp > strtotime($record->expires_at))) {
            return back()->withErrors(['token' => 'Token invalide ou expiré.']);
        }

        // On récupère le type envoyé dans l'URL
        $type = $request->input('type'); // On récupère le type depuis l'URL

        // Mise à jour du mot de passe
        $table = $type == 'adherent' ? 'adherents' : 'partenaires';
        DB::table($table)->where('email', $record->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Supprimer l'entrée après utilisation
        DB::table('password_resets_adherents_partenaires')->where('email', $record->email)->delete();

        return redirect()->route('user.login')->with('success', 'Mot de passe réinitialisé avec succès !');
    }

}
