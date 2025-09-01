<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HierarchySeeder extends Seeder
{
    public function run(): void
    {
        // Create sample directions
        $directions = [
            ['nom' => 'Direction Générale', 'code' => 'DG', 'description' => 'Direction générale de l\'organisation'],
            ['nom' => 'Direction des Ressources Humaines', 'code' => 'DRH', 'description' => 'Gestion des ressources humaines'],
            ['nom' => 'Direction Financière', 'code' => 'DF', 'description' => 'Gestion financière et comptable'],
        ];

        foreach ($directions as $dirData) {
            $direction = Direction::create($dirData);

            // Create sample services for each direction
            $services = [
                ['nom' => 'Service ' . $direction->code . ' 1', 'code' => $direction->code . '_S1', 'direction_id' => $direction->id],
                ['nom' => 'Service ' . $direction->code . ' 2', 'code' => $direction->code . '_S2', 'direction_id' => $direction->id],
            ];

            foreach ($services as $serviceData) {
                Service::create($serviceData);
            }
        }

        // Create some sample users
        $users = [
            [
                'name' => 'Admin User',
                'nom' => 'Admin',
                'prenom' => 'User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'direction_id' => 1,
                'service_id' => 1,
            ],
            [
                'name' => 'John Doe',
                'nom' => 'Doe',
                'prenom' => 'John',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'direction_id' => 2,
                'service_id' => 3,
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}