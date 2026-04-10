<?php

namespace App\Services;

use App\Constants\Geral;
use App\Repository\UserRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\PetRequest;
use App\Repository\PetRepository;
use Illuminate\Support\Facades\Auth;

class PetService
{
    protected $repository;

    public function __construct(PetRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function create(PetRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();

        if ($user->tipo_id === Geral::VETERINARIO) {
            $userId = $data['user_id'];
        } else {
            $userId = $user->id;
        }

        $pet = $this->repository->create($data, $userId);

        return $pet;
    }

    public function edit($id)
    {
        return $this->repository->find($id);
    }

    public function update($request, $id)
    {
        $data = $request->all();
        $tutor = Auth::user();

        $pet = $this->repository->find($id);

        if($tutor->id == $pet->user_id){
            $pet->update($data);

            return $pet;
        }

        return ['status' => 404, 'message' => "Pet não encontrado"];
    }

    public function list($request)
    {
        $userId = $request->user()->id;
        $isVeterinario = $request->user()->tipo_id == 1 ? true : false;

        return $this->repository->list($userId, $isVeterinario);
    }

    public function search($request)
    {
        $userId = $request->user()->id;
        $isVeterinario = $request->user()->tipo_id == 1 ? true : false;

        return $this->repository->search($request, $userId, $isVeterinario);
    }

    public function select($request, $id)
    {
        $userId = $request->user()->id;

        return $this->repository->select($id, $userId);
    }

    public function report($request)
    {
        $userId = $request->user()->id;
        $isVeterinario = $request->user()->tipo_id == 1 ? true : false;

        $pets = $this->repository->report($userId, $isVeterinario);

        $data = [
            'title' => Geral::TITLE_REPORT,
            'pets' => $pets
        ];

        $pdf = Pdf::loadView('pdf.report', $data);

        return $pdf->download('relatorio.pdf');
    }

    public function delete($request, $id)
    {
        $userId = $request->user()->id;

        $pet = $this->repository->find($id);

        if ($pet == null || $userId != $pet->user_id) {
            return null;
        }

        return $this->repository->delete($id);
    }

    public function demise($request, $id)
    {
        $data = $request->all();

        return $this->repository->demise($data['data_falecimento'], $id);
    }
}
