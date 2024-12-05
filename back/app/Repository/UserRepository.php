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
        return $this->query($id)->get();
    }

    public function update($dataUpdate, $id)
    {
        $user = User::find($id);

        $user->update($dataUpdate);

        return $user;
    }

    private function query($id)
    {
        return User::with('tipo_usuario:id,descricao', 'pets', 'pets.especie:id,descricao', 'pets.raca:id,descricao')
            ->where('id', $id);
    }
}
