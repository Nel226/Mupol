<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('pages.backend.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('pages.backend.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            // 'roles' => 'array'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::findOrFail($request->role); 
        

        $user->assignRole($role);
        
        
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('pages.backend.users.edit', compact('user', 'roles'));
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

