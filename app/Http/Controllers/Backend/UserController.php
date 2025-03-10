<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Mail\Users\CreateUserMail;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
class UserController extends Controller
{
    public function index()
    {
        $pageTitle = "Utilisateurs";

        $users = User::with('roles')->get();

        return view('pages.backend.users.index', compact('users', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Nouvel utilisateur";

        $roles = Role::all();
        return view('pages.backend.users.create', compact('roles', 'pageTitle'));
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::findOrFail($request->role); 
        $user->assignRole($role);
        // Envoyer l'email de confirmation
        Mail::to($user->email)->send( new CreateUserMail($user, $role) );
        
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }


    public function edit(User $user)
    {
        $pageTitle = "Modifier utilisateur";

        $roles = Role::all();
        return view('pages.backend.users.edit', compact('user', 'roles', 'pageTitle'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}

