<?php

namespace App\Services;

use App\Models\Pet;
use App\Http\Requests\PetRequest;
use Illuminate\Support\Facades\DB;

class PetService
{
    public function create(PetRequest $request)
    {
        $data = $request->all();

        $pet = new Pet();

        $pet->nome = $data['nome'];
        $pet->peso = $data['peso'];
        $pet->raca_id = $data['raca'];
        $pet->sexo = $data['sexo'];
        $pet->user_id = $data['usuario']['id'];
        $pet->especie_id = $data['especie'];
        $pet->data_nascimento = $data['data_nascimento'];
        $pet->data_falecimento = $data['data_falecimento'];

        $pet->save();
    }

    public function edit($id)
    {
        $pet = Pet::find($id);

        $info = ($pet == NULL ?
            ['status' => false, 'message' => 'Pet não encotrado'] :
            ['status' => true, 'message' => 'Pet encotrado', "pet" => $pet]
        );


        return $info;
    }

    public function update($request, $id)
    {
        $data = $request->all();

        $pet = Pet::find($id);

        $pet->update($data);

        return $pet;
    }

    public function list($request)
    {
        $user = $request->user();

        $query = Pet::select(
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
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->paginate(10);

        return ['status' => true, "pets" => $query, "usuario" => $user];
    }

    public function select($request, $id)
    {
        $user = $request->user();

        $query = Pet::where('id', DB::raw($id))
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->get();

        return $query;
    }
}
