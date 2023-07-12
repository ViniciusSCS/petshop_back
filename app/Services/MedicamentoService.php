<?php

namespace App\Services;

use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;

class MedicamentoService
{
    public function create($request)
    {
        $data = $request->all();

        $medicamento = new Medicamento();

        $medicamento->descricao = $data['descricao'];
        $medicamento->tipo_medicamento_id = $data['tipo_medicamento'];
        $medicamento->valor = $data['valor'];

        $medicamento->save();
    }

    public function list()
    {
        $query = Medicamento::select(
            'descricao',
            'tipo_medicamento_id',
            DB::raw("CONCAT('R$ ', valor) as valor")
        )
            ->with('tipo_medicamento')
            ->get();

        return $query;
    }
}
