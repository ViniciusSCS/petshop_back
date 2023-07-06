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

            if($user->isAtivo != 1){
                return ['status' => false, 'message' => 'Usuário foi deletado ou inativo!'];
            }

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, 'message' => 'Usuário logado com sucesso!', "usuario" => $user];


        } else {
            return ['status' => false, 'message' => 'Usuário ou senha estão incorretos'];
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

        return ['status' => true, 'message' => 'Usuário deslogado com sucesso!'];

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
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'tipo_id' => $data['tipo'],
            'password' => bcrypt($data['password']),
            'isAtivo' => 1
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
    }

    /**
     * @OA\Get(
     *      tags={"User"},
     *      path="/user/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta informações do usuário logado"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
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
     * @OA\Put(
     *     tags={"User"},
     *     path="/user/edit",
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
    public function edit(UserUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->all();

        // dd(isset($data['password']));

        if (isset($data['password'])) {
            $data = [
                'name' => $data['name'],
                'email' => strtolower($data['email']),
                'tipo_id' => $data['tipo'],
                'password'  => bcrypt($data['password'])
            ];

        } else {
            $data = [
                'name' => $data['name'],
                'email' => strtolower($data['email']),
                'tipo_id' => $data['tipo'],
            ];
        }

        $user = User::find($user->id);

        $user->update($data);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
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
