<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class PetController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class PetController extends Controller
{
    /**
     * @OA\Post(
     *     tags={"Pet"},
     *     path="/pet/cadastro",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="peso",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="raca",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="sexo",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="especie",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="data_nascimento",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="data_falecimento",
     *         required=false,
     *     ),
     *     @OA\Response(response="200", description="Cadastra as informações do Pet"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
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

        return ['status' => true, "pet" => $pet];
    }

    /**
     * @OA\Get(
     *     tags={"Pet"},
     *     path="/pet/editar/{id}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="Pet id",
     *         in="/editar/{id}",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Apresenta a informação do Pet selecionado"),
     *     @OA\Response(response="204", description="Pet não encotrado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function edit($id)
    {
        $pet = Pet::find($id);

        $info = ($pet == NULL ?
                ['status' => true, 'message' => 'Pet não encotrado'] :
                ['status' => true, 'message' => 'Pet encotrado', "pet" => $pet]);


        return $info;
    }

    /**
     * @OA\Put(
     *     tags={"Pet"},
     *     path="/pet/atualizar/{id}",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         description="Pet id",
     *         in="/atualizar/{id}",
     *         required=true,
     *         @OA\Schema(
     *              type="integer",
     *              format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         required=true,
     *         @OA\Schema(
     *              type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="peso",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="raca",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="sexo",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="especie",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="data_nascimento",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="data_falecimento",
     *         required=false,
     *     ),
     *     @OA\Response(response="200", description="Atualiza as informações do Pet"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function update(PetRequest $request, $id)
    {
        $data = $request->all();

        $pet = Pet::find($id);

        $pet->update($data);

        return ['status' => true, "pet" => $pet];
    }

    /**
     * @OA\Get(
     *     tags={"Pet"},
     *     path="/pet/listar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Lista os Pets cadastrados referentes ao usuário logado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function list(Request $request)
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

    /**
     * @OA\Get(
     *      tags={"Pet"},
     *      path="/pet/select/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
     *          in="/select/{id}",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(response="200", description="Apreseta todos os Pets cadastrados referentes ao usuário logado"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function select(Request $request, $id)
    {
        $user = $request->user();
        $query = Pet::where('id', DB::raw($id))
            ->where('user_id', '=', DB::raw("'" . $user->id . "'"))
            ->get();

        return ['status' => true, "pets" => $query];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
