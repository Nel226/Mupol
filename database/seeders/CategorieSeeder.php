<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        $depensesCategories = [
            [
                'nom' => 'Service / Remboursement de la dette',
                'type' => 'depense',
                'children' => []
            ],
            [
                'nom' => 'Prestations et dépenses de personnels',
                'type' => 'depense',
                'children' => [
                    ['nom' => 'Couverture des risques maladies ou accidents'],
                    ['nom' => 'Maternité'],
                    ['nom' => 'Secours médical'],
                    ['nom' => 'Allocation de décès'],
                    ['nom' => 'Allocation de décès d’un ayant droit'],
                    ['nom' => 'Allocation d\'invalidité de l’adhérent'],
                    ['nom' => 'Salaires ou indemnités du personnel (5% des frais de cotisation)']
                ]
            ],
            [
                'nom' => 'Fonctionnement',
                'type' => 'depense',
                'children' => [
                    ['nom' => 'Carburant et déplacement'],
                    ['nom' => 'Mission à l’intérieur pays'],
                    ['nom' => 'Mission à l’extérieur du pays'],
                    ['nom' => 'Restauration'],
                    ['nom' => 'Loyers'],
                    ['nom' => 'Gardiennage'],
                    ['nom' => 'Fournitures'],
                    ['nom' => 'Entretien courant'],
                    ['nom' => 'Réparation'],
                    ['nom' => 'Consommation d’eau, d’électricité, de téléphone, de la connexion à internet'],
                    ['nom' => 'Consultation'],
                    ['nom' => 'Autres frais non encore ventilé']
                ]
            ],
            [
                'nom' => 'Investissement',
                'type' => 'depense',
                'children' => [
                    ['nom' => 'Acquisitions'],
                    ['nom' => 'Constructions'],
                    ['nom' => 'Réhabilitations/Réfections']
                ]
            ]
        ];

        $recettesCategories = [
            [
                'nom' => 'Prêts',
                'type' => 'recette',
                'children' => []
            ],
            [
                'nom' => 'Recettes propres',
                'type' => 'recette',
                'children' => [
                    ['nom' => 'Cotisations des membres (Adhésions et cotisations)'],
                    ['nom' => 'Contributions des membres honoraires']
                ]
            ],
            [
                'nom' => 'Produits',
                'type' => 'recette',
                'children' => [
                    ['nom' => 'Financier de placement'],
                    ['nom' => 'Patrimoine mobilier ou immobilier'],
                    ['nom' => 'Œuvres sanitaires et sociales'],
                    ['nom' => 'Activités génératrices de revenus']
                ]
            ],
            [
                'nom' => 'Autres',
                'type' => 'recette',
                'children' => [
                    ['nom' => 'Dons et legs'],
                    ['nom' => 'Frais de dossiers'],
                    ['nom' => 'Autres ressources non interdites par la loi']
                ]
            ]
        ];

      

        foreach ($recettesCategories as $categoryData) {
            $this->createCategoryWithChildren($categoryData);
        }

        foreach ($depensesCategories as $categoryData) {
            $this->createCategoryWithChildren($categoryData);
        }
    }

    private function createCategoryWithChildren(array $data, $parent_id = null)
    {
        $category = Categorie::create([
            'uuid' => (string) Str::uuid(),
            'nom' => $data['nom'],
            'type' => $data['type'] ?? 'depense',
            'parent_id' => $parent_id,
        ]);

        if (!empty($data['children'])) {
            foreach ($data['children'] as $childData) {
                $this->createCategoryWithChildren($childData, $category->uuid);
            }
        }
    }
}
