<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProcedimentoController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 15:26
 * @package App\Http\Controllers
 */
class ProcedimentoController extends Controller
{

    /**
     * @param Request $request
     * @return $procedimento
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $procedimento = new Procedimento();

        $procedimento->pet_id = $data['pet_id'];
        $procedimento->vacina_id = $data['vacina'];
        $procedimento->castrado = $data['castrado'];
        $procedimento->cirurgia_id = $data['cirurgia'];
        $procedimento->banho_tosa = $data['banho_tosa'];
        $procedimento->user_id = $data['user_id']['id'];
        $procedimento->data_castracao = $data['data_castracao'];
        $procedimento->user_created = $data['user_created']['id'];
        $procedimento->descricao_cirurgica = $data['descricao_cirurgia'];
        $procedimento->medicamento_id = $data['medicamento_id'];

        $procedimento->save();

        return ['status' => true, "procedimento" => $procedimento];

    }

    /**
     * @param Request $request
     */
    public function list(Request $request)
    {
        $query = Procedimento::with('dono_pet')
            ->with('veterinario_pet')
            ->get();

        return ['status' => true, "procedimento" => $query];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
