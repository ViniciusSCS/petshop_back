<?php

namespace App\Services;

use App\Constants\Geral;
use Barryvdh\DomPDF\Facade\Pdf;
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
        return $this->repository->find($id);
    }

    public function update($request, $id)
    {
        $data = $request->all();

        $pet = $this->repository->find($id);

        $pet->update($data);

        return $pet;
    }

    public function list($request)
    {
        $user = $request->user();

        return $this->repository->list($request, $user->id);
    }

    public function select($request, $id)
    {
        $user = $request->user();

        $query = $this->repository->select($id, $user->id);

        return $query;
    }

    public function report($request)
    {
        $user = $request->user();

        $pets = $this->repository->report($user->id);

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
