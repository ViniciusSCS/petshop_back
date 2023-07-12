<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\PetRequest;
use App\Services\PetService;
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

    protected $service;

    public function __construct(PetService $service)
    {
        $this->service = $service;
    }

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
        $pet = $this->service->create($request);

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
        $pet = $this->service->edit($id);

        return $pet;
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
        $pet = $this->service->update($request, $id);

        return ['status' => true, 'message' => 'Pet atualizado com sucesso', "pet" => $pet];
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
        $query = $this->service->list($request);

        return $query;
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
        $query = $this->service->select($request, $id);

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
