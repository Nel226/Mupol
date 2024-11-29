<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Assurez-vous que ce request est correct
use App\Mail\OtpMail;
use App\Models\Adherent; 
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdherentAuthenticatedSessionController extends Controller
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
            $request->session()->regenerate();
            $adherent = Auth::guard('adherent')->user();
            if ($adherent->must_change_password) {
                return redirect()->route('adherents.change-password');
            }
            $this->sendOtp($adherent);
            return redirect()->route('adherents.verify-otp');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification sont incorrectes.',
            'password' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }

    public function showChangePasswordForm(): View
    {
        return view('pages.frontend.adherents.auth.change-password');
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

        $adherent = Auth::guard('adherent')->user();
        $adherent->password = Hash::make($request->password);
        $adherent->must_change_password = false; 
        $adherent->save();

        return redirect()->route('adherents.dashboard')->with('status', 'Votre mot de passe a été mis à jour avec succès.');
    }
  

    public function sendOtp(Adherent $adherent)
    {
        $otp = random_int(100000, 999999);

        session(['otp' => $otp]);
        Mail::to($adherent->email)->send(new OtpMail($otp));

    }

    public function showVerifyOtpForm(): View
    {
        return view('pages.frontend.adherents.auth.verify-otp');
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate(['otp' => 'required|numeric']);

        if ($request->otp == session('otp')) {
            session()->forget('otp');

            return redirect()->route('adherents.dashboard')->with('status', 'Connexion réussie.');
        }

        return back()->withErrors(['otp' => 'Le code OTP est incorrect.']);
    }

    public function dashboard(): View
    {
        $adherent = Auth::guard('adherent')->user();
        $adherent->ayantsDroits = json_decode($adherent->ayantsDroits, true); 

        return view('pages.frontend.adherents.dashboard', compact('adherent'));
    }


    /**
     * Détruire une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('adherent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
    
}
