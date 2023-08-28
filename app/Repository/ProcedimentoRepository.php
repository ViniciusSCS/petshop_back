<?php

namespace App\Repository;

use App\Models\Procedimento;

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

    private function query()
    {
        return Procedimento::with('pet')
            ->with('tutor')
            ->with('veterinario_pet');
    }
}
