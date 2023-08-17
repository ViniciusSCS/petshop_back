<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{

    public function create($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'tipo_id' => $data['tipo'],
            'password' => bcrypt($data['password']),
            'isAtivo' => 1
        ]);

        return $user;
    }

    public function me($id)
    {
        $query = User::with('tipo_usuario')
            ->with('pets')
            ->with('pets.especie')
            ->with('pets.raca')
            ->where('id', $id)
            ->get();

        return $query;
    }

    public function edit($data)
    {
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

        return $data;
    }

    public function update($dataUpdate, $id)
    {
        $user = User::find($id);

        $user->update($dataUpdate);

        return $user;
    }
}
