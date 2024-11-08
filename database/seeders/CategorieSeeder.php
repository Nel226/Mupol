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
                    ['nom' => 'Couverture des risques maladies ou accidents', 'type' => 'depense'],
                    ['nom' => 'Maternité', 'type' => 'depense'],
                    ['nom' => 'Secours médical', 'type' => 'depense'],
                    ['nom' => 'Allocation de décès', 'type' => 'depense'],
                    ['nom' => 'Allocation de décès d’un ayant droit', 'type' => 'depense'],
                    ['nom' => 'Allocation d\'invalidité de l’adhérent', 'type' => 'depense'],
                    ['nom' => 'Salaires ou indemnités du personnel (5% des frais de cotisation)', 'type' => 'depense']
                ]
            ],
            [
                'nom' => 'Fonctionnement',
                'type' => 'depense',
                'children' => [
                    ['nom' => 'Carburant et déplacement', 'type' => 'depense'],
                    ['nom' => 'Mission à l’intérieur pays', 'type' => 'depense'],
                    ['nom' => 'Mission à l’extérieur du pays', 'type' => 'depense'],
                    ['nom' => 'Restauration', 'type' => 'depense'],
                    ['nom' => 'Loyers', 'type' => 'depense'],
                    ['nom' => 'Gardiennage', 'type' => 'depense'],
                    ['nom' => 'Fournitures', 'type' => 'depense'],
                    ['nom' => 'Entretien courant', 'type' => 'depense'],
                    ['nom' => 'Réparation', 'type' => 'depense'],
                    ['nom' => 'Consommation d’eau, d’électricité, de téléphone, de la connexion à internet', 'type' => 'depense'],
                    ['nom' => 'Consultation', 'type' => 'depense'],
                    ['nom' => 'Autres frais non encore ventilé', 'type' => 'depense']
                ]
            ],
            [
                'nom' => 'Investissement',
                'type' => 'depense',
                'children' => [
                    ['nom' => 'Acquisitions', 'type' => 'depense'],
                    ['nom' => 'Constructions', 'type' => 'depense'],
                    ['nom' => 'Réhabilitations/Réfections', 'type' => 'depense']
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
                    ['nom' => 'Cotisations des membres (Adhésions et cotisations)', 'type' => 'recette'],
                    ['nom' => 'Contributions des membres honoraires', 'type' => 'recette']
                ]
            ],
            [
                'nom' => 'Produits',
                'type' => 'recette',
                'children' => [
                    ['nom' => 'Financier de placement', 'type' => 'recette'],
                    ['nom' => 'Patrimoine mobilier ou immobilier', 'type' => 'recette'],
                    ['nom' => 'Œuvres sanitaires et sociales', 'type' => 'recette'],
                    ['nom' => 'Activités génératrices de revenus', 'type' => 'recette']
                ]
            ],
            [
                'nom' => 'Autres',
                'type' => 'recette',
                'children' => [
                    ['nom' => 'Dons et legs', 'type' => 'recette'],
                    ['nom' => 'Frais de dossiers', 'type' => 'recette'],
                    ['nom' => 'Autres ressources non interdites par la loi', 'type' => 'recette']
                ]
            ]
        ];

        // Création des catégories de recettes
        foreach ($recettesCategories as $categoryData) {
            $this->createCategoryWithChildren($categoryData);
        }

        // Création des catégories de dépenses
        foreach ($depensesCategories as $categoryData) {
            $this->createCategoryWithChildren($categoryData);
        }
    }

    private function createCategoryWithChildren(array $data, $parent_id = null)
    {
        $category = Categorie::create([
            'uuid' => (string) Str::uuid(),
            'nom' => $data['nom'],
            'type' => $data['type'],
            'parent_id' => $parent_id,
        ]);

        if (!empty($data['children'])) {
            foreach ($data['children'] as $childData) {
                // Si 'type' ou 'sous_type' ne sont pas définis dans l'enfant, on les copie depuis le parent
                $childData['type'] = $childData['type'] ?? $data['type'];
                $this->createCategoryWithChildren($childData, $category->uuid);
            }
        }
    }
}
