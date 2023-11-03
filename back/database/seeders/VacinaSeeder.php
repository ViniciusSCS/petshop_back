<?php

namespace Database\Seeders;

use App\Models\Vacina;
use Illuminate\Database\Seeder;

class VacinaSeeder extends Seeder
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
                'descricao' => 'V8 E V10'
            ],
            [
                'descricao' => 'TRAQUEOBRONQUITE INFECCIOSA CANINA'
            ],
            [
                'descricao' => 'GIARDÍASE'
            ],
            [
                'descricao' => 'ANTIRÁBICA'
            ],
            [
                'descricao' => 'GRIPE CANINA'
            ],
            [
                'descricao' => 'POLIVALENTE OU MÚLTIPLA'
            ],
            [
                'descricao' => 'LEISHMANIOSE'
            ],
            [
                'descricao' => 'FILARIOSE'
            ],
            [
                'descricao' => 'PANLEUCOPENIA'
            ],
            [
                'descricao' => 'LEUCEMIA FELINA (FELV)'
            ],
            [
                'descricao' => 'COMPLEXO REESPIRATÓRIO FELINO'
            ],
        ];

        foreach ($tipos as $tipo) {
            Vacina::UpdateOrCreate($tipo, $tipo);
        }
    }
}
