<?php

namespace App\Services;

use App\Models\User;

class UsuarioService
{
    public function create($request)
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

        return $user;
    }

    public function user($id)
    {
        $query = User::with('tipo_usuario')
            ->with('pets')
            ->with('pets.especie')
            ->where('id', $id)
            ->get();

        return $query;
    }

    public function edit($request)
    {
        $user = $request->user();
        $data = $request->all();

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
