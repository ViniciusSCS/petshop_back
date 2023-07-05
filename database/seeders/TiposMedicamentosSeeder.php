<?php

namespace Database\Seeders;

use App\Models\TiposMedicamentos;
use Illuminate\Database\Seeder;

class TiposMedicamentosSeeder extends Seeder
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
                'descricao' => 'Antipulgas e Carrapatos'
            ],
            [
                'descricao' => 'Antibióticos'
            ],
            [
                'descricao' => 'Analgésicos'
            ],
            [
                'descricao' => 'Anti-inflamatórios'
            ],
            [
                'descricao' => 'Cicatrizantes'
            ],
            [
                'descricao' => 'Antialérgicos'
            ]
        ];

        foreach ($tipos as $tipo) {
            TiposMedicamentos::UpdateOrCreate($tipo, $tipo);
        }
    }
}
