<?php

namespace App\Repository;

use App\Models\Vacina;

class VacinaRepository
{
    public function findAll()
    {
        return Vacina::all();
    }

    public function search($request)
    {
        $query = $this->query();

        $query = $this->searchQuery($request, $query);

        return $query->paginate(10);
    }

    private function query()
    {
        return Vacina::select(
            'descricao',
        );
    }

    private function searchQuery($request, $query)
    {
        if ($request->has('descricao')) {
            $query->where('descricao', 'LIKE', '%' . $request->descricao . '%');
        }

        return $query;
    }
}
