<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function create($type, $token)
    {
        return view('auth.passwords.reset', ['token' => $token, 'type' => $type]);
    }

    public function store(Request $request, $type)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $broker = $this->getPasswordBroker($type);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
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
