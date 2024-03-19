<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //creo un account falso per gestire
        \App\Models\User::factory()->create([
            'name' => 'Biagio',
            'email' => 'biagio@ciao.it',
        ]);

        // \App\Models\User::factory(10)->create();
        \App\Models\Project::factory(20)->create();
    }
}
