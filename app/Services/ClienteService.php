<?php

namespace App\Services;

use App\Models\ClienteModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ClienteService
{
    public function getPaginatedClientes(int $perPage = 10): LengthAwarePaginator
    {
        return ClienteModel::latest()->paginate($perPage);
    }

    public function createCliente(array $data): ClienteModel
    {
        return DB::transaction(function () use ($data) {
            return ClienteModel::create($data);
        });
    }

    public function updateCliente(ClienteModel $cliente, array $data): ClienteModel
    {
        return DB::transaction(function () use ($cliente, $data) {
            $cliente->update($data);
            return $cliente->fresh();
        });
    }

    public function deleteCliente(ClienteModel $cliente): bool
    {
        return DB::transaction(function () use ($cliente) {
            return (bool) $cliente->delete();
        });
    }
}
