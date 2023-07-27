<?php

namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;

class UsuarioService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $data = $request->all();

        $user = $this->repository->create($data);

        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    }

    public function user($id)
    {
        $query = $this->repository->me($id);

        return $query;
    }

    public function edit($request)
    {
        $user = $request->user();
        $data = $request->all();

        $dataUpdate = $this->repository->edit($data);

        $user = User::find($user->id);

        $user->update($dataUpdate);

        $user->token = $user->createToken($user->email)->accessToken;

        return $user;
    }

    public function delete($request)
    {
        $user = $request->user();
        $data = [
            'isAtivo' => false,
            'deleted_at' => now()
        ];

        $user = User::find($user->id);

        $user->update($data);

        return $user;
    }
}
