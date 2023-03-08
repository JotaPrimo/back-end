<?php

namespace Database\Seeders;

use App\Models\API\PetsEstimacao;
use App\Models\Comida;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PetSeeder extends Seeder
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
            PetsEstimacao::create([
                'nome'   => Str::random(10),
                'especie' => $a % 2 == 0 ? 2 : 1,
                'peso' => random_int(5, 15),
                'pelagem' => Str::random(10),
                'sexo' => $a % 2 == 0 ? 2 : 1
            ]);

            $a++;
        }
    }
}
