<?php

namespace App\Services;

use App\Models\ClienteModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ClienteService
{
    public function getPaginatedClientes(int $perPage = 10): LengthAwarePaginator
    {
        return ClienteModel::orderBy('id', 'asc')->paginate($perPage);
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
            
            $maxId = ClienteModel::max('id') ?? 0;
            
            $connection = DB::getDriverName();
            
            if ($connection === 'mysql') {
                DB::statement('ALTER TABLE clientes AUTO_INCREMENT = ' . ($maxId + 1));
            } elseif ($connection === 'pgsql') {
                DB::statement('ALTER SEQUENCE clientes_id_seq RESTART WITH ' . ($maxId + 1));
            } elseif ($connection === 'sqlite') {
                DB::statement('UPDATE sqlite_sequence SET seq = ' . $maxId . ' WHERE name = "clientes"');
            }
            
            return true;
        });
    }
}
