<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\{
    UserRequest,
    LoginRequest,
    UserUpdateRequest
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

/**
 * Class UsuarioController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:50
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, 'message' => 'Usuário logado com sucesso!', "usuario" => $user];

        } else {
            return ['status' => false, 'message' => 'Usuário ou senha incorretos'];
        }
    }

    public function logout(Request $request)
    {
        $tokenId = $request->user()->token()->id;

        $this->tokenRepository->revokeAccessToken($tokenId);

        return ['status' => true, 'message' => 'Usuário deslogado com sucesso!'];

    }

    /**
     * @param Request $request
     * @return array
     */
    public function create(UserRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipo_id' => $data['tipo'],
            'password' => bcrypt($data['password']),
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function user(Request $request)
    {
        $user = $request->user();

        $query = User::with('tipo_usuario')
            ->with('pets')
            ->with('pets.especie')
            ->where('id', $user['id'])
            ->get();

        return ['status' => true, "usuario" => $query];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function edit(Request $request, UserUpdateRequest $updateRequest)
    {
        $user = Auth::user();
        $data = $request->all();

        if (isset($data['password'])) {
            $updateRequest->validated();

            $user->password = bcrypt($data['password']);

        } else {
            $updateRequest->validated();

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->tipo_id = $data['tipo'];
        }

        $user = User::find($user->id);

        $user->update($data);

        $user->token = $user->createToken($user->email)->accessToken;
        return ['status' => true, "usuario" => $user];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
