<?php

namespace Database\Seeders;

use App\Models\Tipo;
use http\Client\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'descricao' => 'Veterinário'
            ],
            [
                'descricao' => 'Cliente'
            ]
        ];

        foreach ($tipos as $tipo) {
            Tipo::UpdateOrCreate($tipo, $tipo);
        }

    }
}
