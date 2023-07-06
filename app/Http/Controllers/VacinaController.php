<?php

namespace App\Http\Controllers;

use App\Models\Vacina;
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
    /**
     * @OA\Get(
     *      tags={"Vacina"},
     *      path="/vacina/select/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta todas as Vacinas cadastradas"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function select()
    {
        $query = Vacina::all();

        return ['status' => true, "vacinas" => $query];
    }
}
