<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // 👕 Vêtements (category_id: 1)
            [
                'name'        => 'Maillot FootConnect Pro 2026',
                'category_id' => 1,
                'price'       => 49.99,
                'sale_price'  => 39.99,
                'stock'       => 50,
                'brand'       => 'FootConnect',
                'description' => 'Maillot officiel FootConnect 2026, tissu respirant et léger.',
                'sizes'       => ['S', 'M', 'L', 'XL', 'XXL'],
                'colors'      => ['Noir', 'Blanc', 'Vert'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Short de Football Pro',
                'category_id' => 1,
                'price'       => 29.99,
                'sale_price'  => null,
                'stock'       => 40,
                'brand'       => 'FootConnect',
                'description' => 'Short léger et confortable pour l\'entraînement et les matchs.',
                'sizes'       => ['S', 'M', 'L', 'XL'],
                'colors'      => ['Noir', 'Bleu', 'Rouge'],
                'is_featured' => false,
            ],
            [
                'name'        => 'Veste d\'Entraînement Elite',
                'category_id' => 1,
                'price'       => 79.99,
                'sale_price'  => 59.99,
                'stock'       => 30,
                'brand'       => 'SportElite',
                'description' => 'Veste coupe-vent imperméable pour les entraînements par tous temps.',
                'sizes'       => ['S', 'M', 'L', 'XL'],
                'colors'      => ['Noir', 'Gris'],
                'is_featured' => true,
            ],

            // ⚽ Ballons & Équipements (category_id: 2)
            [
                'name'        => 'Ballon FIFA Pro Match',
                'category_id' => 2,
                'price'       => 89.99,
                'sale_price'  => 74.99,
                'stock'       => 25,
                'brand'       => 'ProBall',
                'description' => 'Ballon certifié FIFA pour matchs officiels, excellente trajectoire.',
                'sizes'       => ['Taille 5'],
                'colors'      => ['Blanc/Noir', 'Rouge/Noir'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Chaussures de Football Turbo X',
                'category_id' => 2,
                'price'       => 129.99,
                'sale_price'  => 99.99,
                'stock'       => 20,
                'brand'       => 'TurboSport',
                'description' => 'Chaussures à crampons pour terrains naturels, semelle ultra-légère.',
                'sizes'       => ['40', '41', '42', '43', '44', '45'],
                'colors'      => ['Noir/Or', 'Blanc/Bleu'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Protège-tibias Pro Shield',
                'category_id' => 2,
                'price'       => 24.99,
                'sale_price'  => null,
                'stock'       => 60,
                'brand'       => 'ShieldSport',
                'description' => 'Protège-tibias ergonomiques avec cheville intégrée.',
                'sizes'       => ['S', 'M', 'L'],
                'colors'      => ['Noir', 'Blanc'],
                'is_featured' => false,
            ],

            // 💊 Nutrition & Protéines (category_id: 3)
            [
                'name'        => 'Whey Protéine Performance 2kg',
                'category_id' => 3,
                'price'       => 59.99,
                'sale_price'  => 49.99,
                'stock'       => 35,
                'brand'       => 'NutriSport',
                'description' => 'Protéine whey de haute qualité, 24g de protéines par dose.',
                'sizes'       => ['2kg'],
                'colors'      => ['Chocolat', 'Vanille', 'Fraise'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Créatine Monohydrate 500g',
                'category_id' => 3,
                'price'       => 34.99,
                'sale_price'  => null,
                'stock'       => 45,
                'brand'       => 'NutriSport',
                'description' => 'Créatine pure pour augmenter la force et la récupération musculaire.',
                'sizes'       => ['500g'],
                'colors'      => ['Nature'],
                'is_featured' => false,
            ],
            [
                'name'        => 'BCAA Recovery 300g',
                'category_id' => 3,
                'price'       => 29.99,
                'sale_price'  => 24.99,
                'stock'       => 50,
                'brand'       => 'NutriSport',
                'description' => 'Acides aminés essentiels pour la récupération musculaire post-entraînement.',
                'sizes'       => ['300g'],
                'colors'      => ['Citron', 'Fruits rouges'],
                'is_featured' => false,
            ],

            // 🥤 Drinks Énergétiques (category_id: 4)
            [
                'name'        => 'Energy Drink Sport Pack x12',
                'category_id' => 4,
                'price'       => 19.99,
                'sale_price'  => 15.99,
                'stock'       => 80,
                'brand'       => 'EnergyFC',
                'description' => 'Pack de 12 canettes de boisson énergétique, sans sucre ajouté.',
                'sizes'       => ['250ml x12'],
                'colors'      => ['Original', 'Citron', 'Mangue'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Boisson Isotonique 1L',
                'category_id' => 4,
                'price'       => 4.99,
                'sale_price'  => null,
                'stock'       => 100,
                'brand'       => 'HydroSport',
                'description' => 'Boisson isotonique pour la récupération rapide des électrolytes.',
                'sizes'       => ['1L'],
                'colors'      => ['Orange', 'Citron', 'Tropical'],
                'is_featured' => false,
            ],

            // 💧 Eau & Hydratation (category_id: 5)
            [
                'name'        => 'Gourde Sport 750ml',
                'category_id' => 5,
                'price'       => 14.99,
                'sale_price'  => null,
                'stock'       => 70,
                'brand'       => 'HydroFC',
                'description' => 'Gourde isotherme anti-fuite, idéale pour l\'entraînement.',
                'sizes'       => ['750ml'],
                'colors'      => ['Noir', 'Vert', 'Bleu', 'Rouge'],
                'is_featured' => false,
            ],

            // 🏋️ Fitness & Musculation (category_id: 6)
            [
                'name'        => 'Set Altères 2x10kg',
                'category_id' => 6,
                'price'       => 49.99,
                'sale_price'  => 39.99,
                'stock'       => 20,
                'brand'       => 'IronSport',
                'description' => 'Paire d\'altères en néoprène antidérapant, idéal pour renforcement musculaire.',
                'sizes'       => ['2x5kg', '2x10kg', '2x15kg'],
                'colors'      => ['Noir', 'Gris'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Câbles d\'Étirement Résistance',
                'category_id' => 6,
                'price'       => 24.99,
                'sale_price'  => 19.99,
                'stock'       => 55,
                'brand'       => 'FlexSport',
                'description' => 'Set de 5 bandes élastiques de résistances différentes.',
                'sizes'       => ['Léger', 'Moyen', 'Fort', 'Très fort', 'Extrême'],
                'colors'      => ['Multicolore'],
                'is_featured' => false,
            ],

            // ⌚ Montres & Tech Sport (category_id: 7)
            [
                'name'        => 'Montre GPS Sport Pro',
                'category_id' => 7,
                'price'       => 199.99,
                'sale_price'  => 169.99,
                'stock'       => 15,
                'brand'       => 'TechSport',
                'description' => 'Montre GPS avec suivi cardiaque, autonomie 7 jours, waterproof 50m.',
                'sizes'       => ['Unique'],
                'colors'      => ['Noir', 'Bleu', 'Rouge'],
                'is_featured' => true,
            ],

            // ❤️ Détecteurs Cardiaque (category_id: 8)
            [
                'name'        => 'Ceinture Cardiaque Pro',
                'category_id' => 8,
                'price'       => 69.99,
                'sale_price'  => 54.99,
                'stock'       => 25,
                'brand'       => 'CardioFC',
                'description' => 'Ceinture cardiaque Bluetooth ANT+ compatible avec toutes les montres sport.',
                'sizes'       => ['S/M', 'L/XL'],
                'colors'      => ['Noir'],
                'is_featured' => true,
            ],
            [
                'name'        => 'Oxymètre de Pouls Sport',
                'category_id' => 8,
                'price'       => 29.99,
                'sale_price'  => null,
                'stock'       => 40,
                'brand'       => 'CardioFC',
                'description' => 'Mesure précise du pouls et de la saturation en oxygène.',
                'sizes'       => ['Unique'],
                'colors'      => ['Noir', 'Blanc'],
                'is_featured' => false,
            ],

            // 🏥 Équipements Médicaux (category_id: 9)
            [
                'name'        => 'Genouillère Sport Pro',
                'category_id' => 9,
                'price'       => 34.99,
                'sale_price'  => 27.99,
                'stock'       => 45,
                'brand'       => 'MediSport',
                'description' => 'Genouillère de compression pour la prévention et la récupération.',
                'sizes'       => ['S', 'M', 'L', 'XL'],
                'colors'      => ['Noir', 'Beige'],
                'is_featured' => false,
            ],
            [
                'name'        => 'Chevillère Stabilisatrice',
                'category_id' => 9,
                'price'       => 29.99,
                'sale_price'  => null,
                'stock'       => 35,
                'brand'       => 'MediSport',
                'description' => 'Chevillère semi-rigide pour la stabilisation et la prévention des entorses.',
                'sizes'       => ['S', 'M', 'L'],
                'colors'      => ['Noir'],
                'is_featured' => false,
            ],

            // 🔗 Câbles & Étirements (category_id: 10)
            [
                'name'        => 'Rouleau de Massage Foam Roller',
                'category_id' => 10,
                'price'       => 19.99,
                'sale_price'  => 14.99,
                'stock'       => 60,
                'brand'       => 'RecovSport',
                'description' => 'Rouleau de massage pour la récupération musculaire et la flexibilité.',
                'sizes'       => ['30cm', '45cm', '60cm'],
                'colors'      => ['Noir', 'Bleu'],
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'vendor_id'   => 1,
                'category_id' => $product['category_id'],
                'name'        => $product['name'],
                'slug'        => Str::slug($product['name']) . '-' . uniqid(),
                'description' => $product['description'],
                'price'       => $product['price'],
                'sale_price'  => $product['sale_price'],
                'stock'       => $product['stock'],
                'brand'       => $product['brand'],
                'sizes'       => $product['sizes'],
                'colors'      => $product['colors'],
                'is_featured' => $product['is_featured'],
                'is_active'   => true,
            ]);
        }

        $this->command->info('✅ 20 produits créés !');
    }
}