<?php

namespace App\Repository;

use App\Models\TiposMedicamentos;

class TipoMedicamentoRepository
{

    public function create($data)
    {
        return $tipoMedicamento = TiposMedicamentos::create([
            'descricao' => $data['descricao']
        ]);
    }

    public function list()
    {
        return TiposMedicamentos::select('descricao')->get();
    }
}
