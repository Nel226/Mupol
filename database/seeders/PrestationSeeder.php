<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestationSeeder extends Seeder
{
    public function run()
    {
        // Définir les types de prestations
        $types = ['consultation', 'hospitalisation'];

        // Générer des prestations fictives
        for ($i = 0; $i < 10; $i++) {
            // Générer une date aléatoire pour 'date'
            $date = Carbon::now()->subMonths(rand(0, 11))->startOfMonth()->addDays(rand(0, 30));
            
            // Générer une date aléatoire pour 'created_at'
            $createdAt = Carbon::now()->subDays(rand(0, 365))->subMinutes(rand(0, 1440));
            
            $type = $types[array_rand($types)];
            $centre = 'Centre ' . rand(1, 10);
            $montant = rand(100, 1000);

            DB::table('prestations')->insert([
                'adherantCode' => 'AD' . str_pad(rand(1, 1000), 4, '0', STR_PAD_LEFT),
                'adherantNom' => 'Nom' . rand(1, 100),
                'adherantPrenom' => 'Prenom' . rand(1, 100),
                'adherantSexe' => rand(0, 1) ? 'M' : 'F',
                'beneficiaire' => 'Beneficiaire' . rand(1, 100),
                'idPrestation' => 'PRE' . str_pad(rand(1, 1000), 4, '0', STR_PAD_LEFT),
                'acte' => 'Acte' . rand(1, 10),
                'type' => $type,
                'sous_type' => 'SousType' . rand(1, 5),
                'date' => $date->toDateString(),
                'centre' => $centre,
                'montant' => $montant,
                'validite' => 'en attente',
                'etat_paiement' => rand(0, 1) ? true : false,
                'preuve' => json_encode([]), // Optionnel
                'created_at' => $createdAt,  // Ajouter la date aléatoire pour created_at
                'updated_at' => $createdAt,  // Ajouter la même date pour updated_at
            ]);
        }
    }
}
