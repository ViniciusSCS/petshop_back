<?php

namespace App\Repository;

use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;

class MedicamentoRepository
{
    public function create($data)
    {
        $medicamento = Medicamento::create([
            'descricao' => $data['descricao'],
            'tipo_medicamento_id' => $data['tipo_medicamento'],
            'valor' => $data['valor']
        ]);

        return $medicamento;
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

    public function update($data, $id)
    {
        $medicamento = Medicamento::find($id);

        $medicamento->update($data);

        return $medicamento;
    }
}
