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
        $adminRole = Role::create(['id' => Str::uuid(), 'name' => 'administrateur', 'guard_name' => 'web']);
        $agentSaisieRole = Role::create(['id' => Str::uuid(), 'name' => 'agentsaisie', 'guard_name' => 'web']);
        $controleurRole = Role::create(['id' => Str::uuid(), 'name' => 'controleur', 'guard_name' => 'web']);
        $comptableRole = Role::create(['id' => Str::uuid(), 'name' => 'comptable', 'guard_name' => 'web']);
        $communityManagerRole = Role::create(['id' => Str::uuid(), 'name' => 'communitymanager', 'guard_name' => 'web']);

        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole->id);

        $agentsaisie = User::create([
            'name' => 'Agent de Saisie',
            'email' => 'agentsaisie@example.com',
            'password' => bcrypt('password'),
        ]);
        $agentsaisie->assignRole($agentSaisieRole->id);

        $controleur = User::create([
            'name' => 'Controleur',
            'email' => 'controleur@example.com',
            'password' => bcrypt('password'),
        ]);
        $controleur->assignRole($controleurRole->id);

        $comptable = User::create([
            'name' => 'Comptable',
            'email' => 'comptable@example.com',
            'password' => bcrypt('password'),
        ]);
        $comptable->assignRole($comptableRole->id);
        $communityManager = User::create([
            'name' => 'Community Manager',
            'email' => 'communitymanager@example.com',
            'password' => bcrypt('password'),
        ]);
        $communityManager->assignRole($communityManagerRole->id);
    }
}
