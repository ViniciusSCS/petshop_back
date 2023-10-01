<?php

namespace App\Repository;

use App\Models\Procedimento;
use Illuminate\Support\Facades\DB;

class ProcedimentoRepository
{
    public function create($request)
    {
        $userId = $request->user()->id;
        $data = $request->all();

        $procedimento = Procedimento::create([
            'pet_id' => $data['pet_id'],
            'vacina_id' => $data['vacina'],
            'castrado' => $data['castrado'],
            'cirurgia_id' => $data['cirurgia'],
            'banho_tosa' => $data['banho_tosa'],
            'user_id' => $data['user_id'],
            'data_castracao' => $data['data_castracao'],
            'user_created' => $userId,
            'descricao_cirurgica' => $data['descricao_cirurgia'],
            'medicamento_id' => $data['medicamento_id']
        ]);

        return $procedimento;
    }

    public function list()
    {
        return $this->query()->paginate(10);
    }

    public function search($request)
    {
        $query = $this->query();

        $query = $this->searchQuery($query, $request);

        return $query->paginate(10);
    }

    private function query()
    {
        return Procedimento::select(
            '*',
            DB::raw("date_format(data_castracao, '%d/%m/%Y') as data_castracao"),
        )
            ->with('pet', 'tutor', 'veterinario_pet');
    }

    private function searchQuery($query, $request)
    {
        if ($request->has('descricao_cirurgica')) {
            $query->where('descricao_cirurgica', 'LIKE', '%' . $request->descricao_cirurgica . '%');
        }

        if ($request->has('data_castracao')) {
            $query->where('data_castracao', $request->data_castracao);
        }

        if ($request->has('pet')) {
            $query->whereHas('pet', function ($query) use ($request) {
                $query->where('nome', 'LIKE',  '%' . $request->pet . '%');
            });
        }

        return $query;
    }
}
