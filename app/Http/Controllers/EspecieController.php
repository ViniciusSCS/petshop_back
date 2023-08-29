<?php

namespace App\Http\Controllers;

use App\Services\EspecieService;

/**
 * Class EspecieController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class EspecieController extends Controller
{
    protected $service;

    public function __construct(EspecieService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      tags={"Especie"},
     *      path="/especie/select",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta todas as Espécies"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     * @return App\Models\Especie
     */
    public function select()
    {
        $query = $this->service->select();

        return ['status' => true, "especies" => $query];
    }
}
