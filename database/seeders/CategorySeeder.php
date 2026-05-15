<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Vêtements',
                'icon'        => '👕',
                'description' => 'Tshirts, maillots, shorts, vestes de sport',
            ],
            [
                'name'        => 'Ballons & Équipements',
                'icon'        => '⚽',
                'description' => 'Ballons de foot, chaussures, protège-tibias, gants',
            ],
            [
                'name'        => 'Nutrition & Protéines',
                'icon'        => '💊',
                'description' => 'Protéines, créatine, acides aminés, compléments',
            ],
            [
                'name'        => 'Drinks Énergétiques',
                'icon'        => '🥤',
                'description' => 'Boissons énergétiques, isotoniques, eau de sport',
            ],
            [
                'name'        => 'Eau & Hydratation',
                'icon'        => '💧',
                'description' => 'Eau minérale, gourdes, bouteilles de sport',
            ],
            [
                'name'        => 'Fitness & Musculation',
                'icon'        => '🏋️',
                'description' => 'Altères, haltères, câbles d\'étirement, élastiques',
            ],
            [
                'name'        => 'Montres & Tech Sport',
                'icon'        => '⌚',
                'description' => 'Montres sportives, GPS, cardiofréquencemètres',
            ],
            [
                'name'        => 'Détecteurs Cardiaque',
                'icon'        => '❤️',
                'description' => 'Cardiomètres, ceintures cardiaques, oxymètres',
            ],
            [
                'name'        => 'Équipements Médicaux',
                'icon'        => '🏥',
                'description' => 'Bandages, genouillères, chevillères, récupération',
            ],
            [
                'name'        => 'Câbles & Étirements',
                'icon'        => '🔗',
                'description' => 'Câbles de résistance, bandes élastiques, rouleaux',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name'        => $category['name'],
                'slug'        => Str::slug($category['name']),
                'icon'        => $category['icon'],
                'description' => $category['description'],
            ]);
        }

        $this->command->info('✅ 10 catégories créées !');
    }
}