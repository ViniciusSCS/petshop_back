<?php

namespace App\Repository;

use App\Models\Procedimento;

class ProcedimentoRepository
{
    public function create($data, $user)
    {
        $procedimento = Procedimento::create([
            'pet_id' => $data['pet_id'],
            'vacina_id' => $data['vacina'],
            'castrado' => $data['castrado'],
            'cirurgia_id' => $data['cirurgia'],
            'banho_tosa' => $data['banho_tosa'],
            'user_id' => $data['user_id'],
            'data_castracao' => $data['data_castracao'],
            'user_created' => $user->id,
            'descricao_cirurgica' => $data['descricao_cirurgia'],
            'medicamento_id' => $data['medicamento_id']
        ]);

        return $procedimento;
    }

    public function list()
    {
        $query = Procedimento::with('tutor')
            ->with('veterinario_pet')
            ->get();

        return $query;
    }
}
