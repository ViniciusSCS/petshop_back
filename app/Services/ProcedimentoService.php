<?php

namespace App\Services;

use App\Models\Procedimento;

class ProcedimentoService
{
    public function create($request)
    {
        $data = $request->all();

        $procedimento = new Procedimento();

        $procedimento->pet_id = $data['pet_id'];
        $procedimento->vacina_id = $data['vacina'];
        $procedimento->castrado = $data['castrado'];
        $procedimento->cirurgia_id = $data['cirurgia'];
        $procedimento->banho_tosa = $data['banho_tosa'];
        $procedimento->user_id = $data['user_id']['id'];
        $procedimento->data_castracao = $data['data_castracao'];
        $procedimento->user_created = $data['user_created']['id'];
        $procedimento->descricao_cirurgica = $data['descricao_cirurgia'];
        $procedimento->medicamento_id = $data['medicamento_id'];

        $procedimento->save();

        return $procedimento;
    }

    public function list()
    {
        $query = Procedimento::with('dono_pet')
            ->with('veterinario_pet')
            ->get();

        return $query;
    }
}
