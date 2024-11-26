<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class RolesAndUsersSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'administrateur']);
        $agentSaisieRole = Role::create(['name' => 'agentsaisie']);
        $controleurRole = Role::create(['name' => 'controleur']);
        $comptableRole = Role::create(['name' => 'comptable']);

        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        $agentsaisie = User::create([
            'name' => 'Agent de Saisie',
            'email' => 'agentsaisie@example.com',
            'password' => bcrypt('password'),
        ]);
        $agentsaisie->assignRole($agentSaisieRole);

        $controleur = User::create([
            'name' => 'Controleur',
            'email' => 'controleur@example.com',
            'password' => bcrypt('password'),
        ]);
        $controleur->assignRole($controleurRole);

        $comptable = User::create([
            'name' => 'Comptable',
            'email' => 'comptable@example.com',
            'password' => bcrypt('password'),
        ]);
        $comptable->assignRole($comptableRole);
    }
}
