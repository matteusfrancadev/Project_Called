<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Establishment::factory()->create([
            'name' => 'Cresauto',
            'cnpj' => '155569982766',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'cpf' => '000.000.000-00',
            'password' => bcrypt('password'),
            'confirmed' => bcrypt('password'),
            'type' => 'Admin'
        ]);
    }
}
