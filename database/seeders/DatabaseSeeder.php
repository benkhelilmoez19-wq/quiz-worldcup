<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création de ton compte Admin
        User::create([
            'name' => 'Moez Ben Khelil',
            'email' => 'benkhelilmoez19@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'nationality' => 'Tunisie',
            'address' => 'Tunis',
        ]);

        // Optionnel : Tu peux décommenter la ligne suivante si tu veux 
        // générer 10 utilisateurs de test pour ton leaderboard plus tard
        // User::factory(10)->create();
    }
}