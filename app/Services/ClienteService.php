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
            $cliente->delete();
            
            
            $clientes = ClienteModel::orderBy('id')->get();
            
            foreach ($clientes as $index => $cli) {
                $cli->update(['id' => $index + 1]);
            }
            
            
            $maxId = ClienteModel::max('id') ?? 0;
            DB::statement('ALTER SEQUENCE clientes_id_seq RESTART WITH ' . ($maxId + 1));
            
            return true;
        });
    }
}
