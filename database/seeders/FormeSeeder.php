<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forme;

class FormeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Forme::create([
            'name'=>"moto",
            'display_nom'=>"Motos"
        ]);
        Forme::create([
            'name'=>"piece",
            'display_nom'=>"Pieces"
        ]);
    }
}
