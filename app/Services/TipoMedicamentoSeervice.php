<?php

namespace App\Services;

use App\Models\TiposMedicamentos;

class TipoMedicamenntoService
{
    public function create($request)
    {
        $data = $request->all();

        $tipoMedicamento = new TiposMedicamentos();

        $tipoMedicamento->descricao = $data['descricao'];

        $tipoMedicamento->save();

        return $tipoMedicamento;
    }

    public function list()
    {
    }
}