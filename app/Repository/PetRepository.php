<?php

namespace App\Repository;

use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class PetRepository
{
    public function find($id)
    {
        return Pet::find($id);
    }

    public function report($id, $isVeterinario)
    {
        return $this->selectQuery($id, $isVeterinario)
            ->get();
    }

    public function create($data, $userId)
    {
        return Pet::create([
            'nome' => $data['nome'],
            'peso' => $data['peso'],
            'raca_id' => $data['raca'],
            'sexo' => $data['sexo'],
            'user_id' => $userId,
            'especie_id' => $data['especie'],
            'data_nascimento' => $data['data_nascimento'],
            'data_falecimento' => $data['data_falecimento']
        ]);
    }

    public function list($request, $userId, $isVeterinario)
    {
        $query = $this->selectQuery($userId, $isVeterinario);

        $query = $this->search($request, $query, $isVeterinario);

        return $query
            ->paginate(10);
    }

    public function select($id, $userId)
    {
        return Pet::where('id', DB::raw($id))
            ->where('user_id', '=', DB::raw("'" . $userId . "'"))
            ->get();
    }

    public function delete($id)
    {
        $pet = $this->find($id);

        $pet->delete();

        return $pet;
    }

    public function demise($death_date, $id)
    {
        $pet = $this->find($id);

        $pet->data_falecimento = $death_date;

        $pet->save();

        return $pet;
    }

    private function selectQuery($userId, $isVeterinario)
    {
        $select = Pet::select(
            '*',
            DB::raw("date_format(data_nascimento, '%d/%m/%Y') as data_nascimento"),
            DB::raw("date_format(data_falecimento, '%d/%m/%Y') as data_falecimento"),
            DB::raw("
                CASE
                    WHEN data_falecimento IS NULL THEN
                        CONCAT(
                            FLOOR(( DATE_FORMAT(NOW(),'%Y%m%d') - DATE_FORMAT(data_nascimento,'%Y%m%d'))/10000), ' ano(s) ',
                            FLOOR((1200 + DATE_FORMAT(NOW(),'%m%d') - DATE_FORMAT(data_nascimento,'%m%d'))/100) %12, ' mes(es) ',
                            REPLACE(
                                (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)) +
                                (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)),
                                '.0000', ''
                            ),' dia(s)'
                        )
                    ELSE
                        CONCAT(
                            FLOOR(( DATE_FORMAT(data_falecimento ,'%Y%m%d') - DATE_FORMAT(data_nascimento,'%Y%m%d'))/10000), ' ano(s) ',
                            FLOOR((1200 + DATE_FORMAT(data_falecimento,'%m%d') - DATE_FORMAT(data_nascimento,'%m%d'))/100) %12, ' mes(es) ',
                            REPLACE(
                                (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)) +
                                (SIGN(DAY(curdate()) - DAY(data_nascimento)))/2 * (DAY(curdate()) - DAY(data_nascimento)),
                                '.0000', ''
                            ),' dia(s)'
                        )
                END as idade
            ")
        )
            ->with('tutor')
            ->with('especie')
            ->with('raca')
            ->with('procedimento')
            ->with('procedimento.tutor')
            ->with('procedimento.veterinario_pet');


        if (!$isVeterinario) {
            $select->where('user_id', '=', DB::raw("'" . $userId . "'"));
        }

        return $select;
    }

    private function search($request, $query, $isVeterinario)
    {
        if ($request->has('nome')) {
            $query->where('nome', 'LIKE', '%' . $request->nome . '%');
        }

        if ($request->has('falecimento')) {
            $query->whereNotNull('data_falecimento');
        }

        if ($request->has('data_nascimento')) {
            $query->where('data_nascimento', $request->data_nascimento);
        }

        if ($request->has('especie')) {
            $query->whereHas('especie', function ($query) use ($request) {
                $query->where('descricao', 'LIKE',  '%' . $request->especie . '%');
            });
        }

        if ($request->has('raca')) {
            $query->whereHas('raca', function ($query) use ($request) {
                $query->where('descricao', 'LIKE',  '%' . $request->raca . '%');
            });
        }

        if ($isVeterinario && $request->has('tutor')) {
            $query->whereHas('tutor', function ($query) use ($request) {
                $query->where('name', 'LIKE',  '%' . $request->tutor . '%');
            });
        }

        return $query;
    }
}
