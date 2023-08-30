<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicamentoRequest;
use App\Services\MedicamentoService;
use Illuminate\Http\Request;

/**
 * Class MedicamentoController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 13/07/2023 - 13:51
 * @package App\Http\Controllers
 */
class MedicamentoController extends Controller
{
    protected $service;

    public function __construct(MedicamentoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *      tags={"Medicamento"},
     *      path="/medicamento/cadastro",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="descricao",
     *          required="true"
     *      ),
     *      @OA\Parameter(
     *          name="tipo_medicamento",
     *          required="true"
     *      ),
     *      @OA\Parameter(
     *          name="valor",
     *          required="true"
     *      ),
     *      @OA\Response(response="200", description="Cadastra os Medicamentos"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     *      @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function create(MedicamentoRequest $request)
    {
        $medicamento = $this->service->create($request);

        return ['status' => true, "medicamento" => $medicamento];
    }

    /**
     * @OA\Get(
     *      tags={"Medicamento"},
     *      path="/medicamento/listar/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Lista os medicamentos cadastrados"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @return App\Models\Medicamento
     */
    public function list()
    {
        $medicamento = $this->service->list();

        return ['status' => true, "medicamento" => $medicamento];
    }

    /**
     * @OA\Get(
     *     tags={"Medicamento"},
     *     path="/medicamento/buscar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Busca os Pets buscados referentes ao usuário logado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @param Request $request
     * @return App\Models\Medicamento
     */
    public function search(Request $request)
    {
        $medicamento = $this->service->search($request);

        return ['status' => true, "medicamento" => $medicamento];
    }

    /**
     * @OA\Put(
     *      tags={"Medicamento"},
     *      path="/medicamento/atualizar/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Medicameto id",
     *          in="/atualizar/{id}",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="descricao",
     *          required="true"
     *      ),
     *      @OA\Parameter(
     *          name="tipo_medicamento",
     *          required="true"
     *      ),
     *      @OA\Parameter(
     *          name="valor",
     *          required="true"
     *      ),
     *      @OA\Response(response="200", description="Atualiza o Medicamento"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     *      @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function update(MedicamentoRequest $request, $id)
    {
        $data = $request->all();

        $medicamento = $this->service->update($data, $id);

        return ['status' => true, 'medicamento' => $medicamento];
    }
}
