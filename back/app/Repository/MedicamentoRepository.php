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
        return $this->query()->get();
    }

    public function update($data, $id)
    {
        $medicamento = Medicamento::find($id);

        $medicamento->update($data);

        return $medicamento;
    }

    public function search($request)
    {
        $query = $this->query();

        $query = $this->searchQuery($query, $request);

        return $query
            ->paginate(10);
    }

    private function query()
    {
        return Medicamento::select(
            'descricao',
            'tipo_medicamento_id',
            DB::raw("CONCAT('R$ ', valor) as valor")
        )
            ->with('tipo_medicamento');
    }

    private function searchQuery($query, $request)
    {
        if ($request->has('descricao')) {
            $query->where('descricao', 'LIKE', '%' . $request->descricao . '%');
        }

        if ($request->has('tipo_medicamento')) {
            $query->whereHas('tipo_medicamento', function ($query) use ($request) {
                $query->where('descricao', 'LIKE',  '%' . $request->tipo_medicamento . '%');
            });
        }

        return $query;
    }
}
