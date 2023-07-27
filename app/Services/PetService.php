<?php

namespace App\Services;

use App\Models\Pet;
use App\Http\Requests\PetRequest;
use App\Repository\PetRepository;

class PetService
{
    protected $repository;

    public function __construct(PetRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(PetRequest $request)
    {
        $user = $request->user();
        $data = $request->all();

        $pet = $this->repository->create($data, $user);

        return $pet;
    }

    public function edit($id)
    {
        $pet = Pet::find($id);

        $info = ($pet == NULL ?
            ['status' => false, 'message' => 'Pet não encotrado'] :
            ['status' => true, 'message' => 'Pet encotrado', "pet" => $pet]
        );

        return $info;
    }

    public function update($request, $id)
    {
        $data = $request->all();

        $pet = Pet::find($id);

        $pet->update($data);

        return $pet;
    }

    public function list($request)
    {
        $user = $request->user();

        $query = $this->repository->list($user->id);

        return ['status' => true, "pets" => $query, "usuario" => $user];
    }

    public function select($request, $id)
    {
        $user = $request->user();

        $query = $this->repository->select($id, $user->id);

        return $query;
    }
}
