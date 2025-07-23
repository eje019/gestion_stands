<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel du seeder de l'admin
        $this->call(AdminUserSeeder::class);

        // (optionnel) Autres seeders ou factories
        // User::factory(10)->create();
    }
}