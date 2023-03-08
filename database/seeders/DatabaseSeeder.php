<?php

namespace Database\Seeders;

use App\Models\Comida;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ComidaSeeder::class);
        $this->call(PetSeeder::class);
    }
}
