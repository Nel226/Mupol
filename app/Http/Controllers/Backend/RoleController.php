<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $pageTitle = "Rôles";

        $roles = Role::all();
        return view('pages.backend.roles.index', compact('roles', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Nouveau rôle";

        return view('pages.backend.roles.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
        ]);

        Role::create($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Rôle créé avec succès.');
    }

    public function edit(Role $role)
    {
        $pageTitle = "Modifier rôle";

        return view('pages.backend.roles.edit', compact('role', 'pageTitle'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'guard_name' => 'required',
        ]);

        $role->update($request->only('name', 'guard_name'));

        return redirect()->route('roles.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rôle supprimé avec succès.');
    }
}
