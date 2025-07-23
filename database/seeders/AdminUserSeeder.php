<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eatdrink.com'],
            [
                'nom_entreprise' => 'Eat&Drink Admin',
                'name' => 'Administrateur',
                'email' => 'admin@eatdrink.com',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );
    }
}