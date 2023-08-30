<?php

namespace App\Http\Controllers;

use App\Services\VacinaService;
use Illuminate\Http\Request;

/**
 * Class VacinaController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class VacinaController extends Controller
{
    protected $service;

    public function __construct(VacinaService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      tags={"Vacina"},
     *      path="/vacina/select/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta todas as Vacinas cadastradas"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @return App\Models\Vacina
     */
    public function select()
    {
        $vacina = $this->service->findAll();

        return ['status' => true, "vacinas" => $vacina];
    }

    public function search(Request $request)
    {
        $vacina = $this->service->search($request);

        return ['status' => true, "vacinas" => $vacina];
    }
}
