<?php

namespace Database\Seeders;

use App\Models\Comida;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a = 0;
        while ($a <= 50) {
            Comida::create([
                'descricao' => Str::random(10),
                'tipo' => 1,
                'preco' => 10,
                'saudavel' => 0
            ]);

            $a++;
        }
    }
}
