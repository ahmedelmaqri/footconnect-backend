<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            ['name' => 'Karim Benzema',    'position' => 'Attaquant',  'nationality' => 'Français'],
            ['name' => 'Riyad Mahrez',     'position' => 'Attaquant',  'nationality' => 'Algérien'],
            ['name' => 'Hakim Ziyech',     'position' => 'Milieu',     'nationality' => 'Marocain'],
            ['name' => 'Achraf Hakimi',    'position' => 'Défenseur',  'nationality' => 'Marocain'],
            ['name' => 'Yassine Bounou',   'position' => 'Gardien',    'nationality' => 'Marocain'],
            ['name' => 'Sofiane Feghouli', 'position' => 'Milieu',     'nationality' => 'Algérien'],
            ['name' => 'Islam Slimani',    'position' => 'Attaquant',  'nationality' => 'Algérien'],
            ['name' => 'Nabil Fekir',      'position' => 'Milieu',     'nationality' => 'Français'],
            ['name' => 'Aymen Barkok',     'position' => 'Milieu',     'nationality' => 'Marocain'],
            ['name' => 'Azzedine Ounahi',  'position' => 'Milieu',     'nationality' => 'Marocain'],
            ['name' => 'Bilal El Khannouss','position' => 'Milieu',    'nationality' => 'Marocain'],
            ['name' => 'Nayef Aguerd',     'position' => 'Défenseur',  'nationality' => 'Marocain'],
            ['name' => 'Romain Saïss',     'position' => 'Défenseur',  'nationality' => 'Marocain'],
            ['name' => 'Noussair Mazraoui','position' => 'Défenseur',  'nationality' => 'Marocain'],
            ['name' => 'Zakaria Aboukhlal','position' => 'Attaquant',  'nationality' => 'Marocain'],
            ['name' => 'Youssef En-Nesyri','position' => 'Attaquant',  'nationality' => 'Marocain'],
            ['name' => 'Sofyan Amrabat',   'position' => 'Milieu',     'nationality' => 'Marocain'],
            ['name' => 'Jawad El Yamiq',   'position' => 'Défenseur',  'nationality' => 'Marocain'],
            ['name' => 'Selim Amallah',    'position' => 'Milieu',     'nationality' => 'Marocain'],
            ['name' => 'Ibrahim Diallo',   'position' => 'Milieu',     'nationality' => 'Guinéen'],
        ];

        foreach ($players as $index => $player) {
            User::create([
                'name'        => $player['name'],
                'email'       => 'player' . ($index + 1) . '@footconnect.com',
                'password'    => Hash::make('password123'),
                'position'    => $player['position'],
                'nationality' => $player['nationality'],
                'role'        => 'player',
                'date_of_birth' => now()->subYears(rand(20, 35))->format('Y-m-d'),
            ]);
        }

        $this->command->info('✅ 20 joueurs créés !');
    }
}