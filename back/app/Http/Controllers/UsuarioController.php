<?php

namespace App\Http\Controllers;

use App\Constants\Geral;
use App\Http\Requests\{
    UserRequest,
    LoginRequest,
    UserUpdateRequest
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use App\Services\UsuarioService;

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
    protected $service;

    public function __construct(TokenRepository $tokenRepository, UsuarioService $service)
    {
        $this->tokenRepository = $tokenRepository;
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     tags={"User"},
     *     path="/login",
     *     @OA\Parameter(
     *         name="email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         required=true,
     *     ),
     *     @OA\Response(response="200", description="Usuário loga com email e senha"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => strtolower($data['email']), 'password' => $data['password']])) {
            $user = auth()->user();

            if ($user->isAtivo != 1) {
                return ['status' => false, 'message' => Geral::USUARIO_DELETADO_INATIVO];
            }

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, 'message' => Geral::USUARIO_LOGADO, "usuario" => $user];
        } else {
            return ['status' => false, 'message' => Geral::USUARIO_INCORRETO];
        }
    }

    /**
     * @OA\Post(
     *     tags={"User"},
     *     path="/logout",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Rota para deslogar usuário e revogar token"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function logout(Request $request)
    {
        $tokenId = $request->user()->token()->id;

        $this->tokenRepository->revokeAccessToken($tokenId);

        return ['status' => true, 'message' => Geral::USUARIO_DESLOGADO];
    }

    /**
     * @OA\Post(
     *      tags={"User"},
     *      path="/user/cadastro",
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="tipo_id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          required=true,
     *      ),
     *      @OA\Response(response="200", description="Cadastra as informações do usuário"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     *      @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function create(UserRequest $request)
    {
        $user = $this->service->create($request);

        return ['status' => true, 'message' => Geral::USUARIO_CADASTRADO, "usuario" => $user];
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      path="/user/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta informações do usuário logado"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @return App\Models\User
     */
    public function user(Request $request)
    {
        $user = $this->service->user($request);

        return ['status' => true, 'message' => Geral::USUARIO_ME, "usuario" => $user];
    }

    /**
     * @OA\Put(
     *     tags={"User"},
     *     path="/user/atualizar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="tipo_id",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         required=true,
     *     ),
     *     @OA\Response(response="200", description="Atualiza as informações do usuário logado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function update(UserUpdateRequest $request)
    {
        $user = $this->service->update($request);

        return ['status' => true, 'message' => Geral::USUARIO_ATUALIZADO, "usuario" => $user];
    }

    /**
     * @OA\Delete(
     *     tags={"User"},
     *     path="/user/deletar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apreseta informações do usuário logado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function delete(Request $request)
    {
        $user = $this->service->delete($request);

        $tokenId = $request->user()->token()->id;
        $this->tokenRepository->revokeAccessToken($tokenId);

        return ['status' => true, 'message' => Geral::USUARIO_DELETADO, "usuario" => $user];
    }
}
