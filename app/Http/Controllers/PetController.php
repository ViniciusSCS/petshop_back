<?php

namespace App\Http\Controllers;

use App\Constants\Geral;
use App\Services\PetService;
use Illuminate\Http\Request;
use App\Http\Requests\PetRequest;
use App\Http\Requests\PetDemiseRequest;

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

        return ['status' => true, "messages" => Geral::PET_CADASTRADO, "pet" => $pet];
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

        return ['status' => true, "messages" => Geral::PET_ENCONTRADOS, "pets" => $query];
    }

    /**
     * @OA\Get(
     *     tags={"Pet"},
     *     path="/pet/buscar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Lista os Pets buscados referentes ao usuário logado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function search(Request $request)
    {
        $query = $this->service->search($request);

        return ['status' => true, "messages" => Geral::PET_ENCONTRADOS, "pets" => $query];
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

        $info = ($pet == NULL ?
            ['status' => false, 'message' => Geral::PET_NAO_ENCONTRADO] :
            ['status' => true, 'message' => Geral::PET_ENCONTRADOS, "pet" => $pet]
        );

        return $info;
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

        return ['status' => true, 'message' => Geral::PET_ENCONTRADOS, "pet" => $query];
    }

    /**
     * @OA\Get(
     *     tags={"Pet"},
     *     path="/pet/relatorio/pet/{id}",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
     *          in="/relatorio/pet/{id}",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apreseta o relatório"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function petReport(Request $request)
    {
        return $this->service->report($request);
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

        return ['status' => true, 'message' => Geral::PET_ATUALIZADO, "pet" => $pet];
    }

    /**
     * @OA\Put(
     *     tags={"Pet"},
     *     path="/pet/pet-falecido/{id}",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
     *          in="/pet-falecido/{id}",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apreseta informações do pet falecido ou Retorno do pet não encontrado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function demise(PetDemiseRequest $request, $id)
    {
        $petDemise = $this->service->demise($request, $id);

        return ['status' => true, 'message' => Geral::PET_LAMENTACAO . $petDemise->nome, "pet" => $petDemise];
    }

    /**
     * @OA\Delete(
     *     tags={"Pet"},
     *     path="/pet/deletar/{id}",
     *      @OA\Parameter(
     *          name="id",
     *          description="Pet id",
     *          in="/deletar/{id}",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apreseta informações do pet deletado ou Retorno do pet não encontrado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function delete(Request $request, $id)
    {
        $pet = $this->service->delete($request, $id);

        $info = ($pet == NULL ?
            ['status' => false, 'message' => Geral::PET_NAO_ENCONTRADO] :
            ['status' => true, 'message' => Geral::PET_EXCLUIDO, "pet" => $pet]
        );

        return $info;
    }
}
