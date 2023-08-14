<?php

namespace App\Repository;

use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class PetRepository
{
    public function find($id)
    {
        $pet = Pet::find($id);

        return $pet;
    }

    public function report($id)
    {
        $pet = $this->selectQuery($id)
            ->get();

        return $pet;
    }

    public function create($data, $user)
    {
        $pet = Pet::create([
            'nome' => $data['nome'],
            'peso' => $data['peso'],
            'raca_id' => $data['raca'],
            'sexo' => $data['sexo'],
            'user_id' => $user->id,
            'especie_id' => $data['especie'],
            'data_nascimento' => $data['data_nascimento'],
            'data_falecimento' => $data['data_falecimento']
        ]);

        return $pet;
    }

    public function list($request, $id)
    {
        $query = $this->selectQuery($id);

        if ($request->has('nome')) {
            $query->where('nome', 'LIKE', '%' . $request->nome . '%');
        }

        if ($request->has('falecimento')) {
            $query->whereNotNull('data_falecimento');
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

        return $query
            ->paginate(10);
    }

    public function select($id, $userId)
    {
        $query = Pet::where('id', DB::raw($id))
            ->where('user_id', '=', DB::raw("'" . $userId . "'"))
            ->get();

        return $query;
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

    private function selectQuery($id)
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
            ->with('dono_pet')
            ->with('especie')
            ->with('raca')
            ->with('procedimento')
            ->with('procedimento.dono_pet')
            ->with('procedimento.veterinario_pet')
            ->where('user_id', '=', DB::raw("'" . $id . "'"));

        return $select;
    }
}
