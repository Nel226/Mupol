<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PartenaireSeeder extends Seeder
{
    public function run()
    {
        $partenaires = [
            // Hôpitaux
            [
                'id' => Str::uuid(),
                'nom' => 'Yalgado',
                'type' => 'hopital',
                'adresse' => 'Paspanga, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 30 45 67',
                'email' => 'yalgado@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/hopital.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nom' => 'St Camille',
                'type' => 'hopital',
                'adresse' => 'Rue 248, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 78 90 12',
                'email' => 'stcamille@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/hopital.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Cliniques
            [
                'id' => Str::uuid(),
                'nom' => 'Yati',
                'type' => 'clinique',
                'adresse' => 'Rue 248, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 34 56 78',
                'email' => 'yati@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/hopital.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nom' => 'Nina',
                'type' => 'clinique',
                'adresse' => 'Rue 248, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 89 67 45',
                'email' => 'nina@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/hopital.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Pharmacies
            [
                'id' => Str::uuid(),
                'nom' => 'Rocher',
                'type' => 'pharmacie',
                'adresse' => 'Place du Marché, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 45 78 90',
                'email' => 'rocher@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/pharmacie.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nom' => 'St Dominique',
                'type' => 'pharmacie',
                'adresse' => 'Rue 248, Ouagadougou',
                'geolocalisation' => 'https://maps.app.goo.gl/G1pCiXJGvdEJ6rAc7',
                'telephone' => '+226 25 67 89 01',
                'email' => 'stdominique@exemple.com',
                'region' => 'Centre',
                'province' => 'Kadiogo',
                'photo' => 'images/partenaires/pharmacie.jpg',
                'password' => Hash::make('password123'),
                'must_change_password' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('partenaires')->insert($partenaires);
    }
}
