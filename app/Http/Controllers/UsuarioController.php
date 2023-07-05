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

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'isAtivo' => 1])) {
            $user = auth()->user();

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, 'message' => 'Usuário logado com sucesso!', "usuario" => $user];

        } else {
            return ['status' => false, 'message' => 'Algo deu errado!!! O Usuário ou senha estão incorretos ou o Usuário foi deletado ou inativo'];
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
            'isAtivo' => 1
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
     * @param UserUpdateRequest $request
     * @return array
     */
    public function edit(UserUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->all();

        // dd(isset($data['password']));

        if (isset($data['password'])) {
            $data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'tipo_id' => $data['tipo'],
                'password'  => bcrypt($data['password'])
            ];

        } else {
            $data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'tipo_id' => $data['tipo'],
            ];
        }

        $user = User::find($user->id);

        $user->update($data);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $user = $request->user();
        $data = [
            'isAtivo' => false,
            'deleted_at' => now()
        ];

        $user = User::find($user->id);

        $user->update($data);

        $tokenId = $request->user()->token()->id;
        $this->tokenRepository->revokeAccessToken($tokenId);

        return ['status' => true, 'message' => 'Usuário deletado com sucesso!', "usuario" => $user];
    }
}
