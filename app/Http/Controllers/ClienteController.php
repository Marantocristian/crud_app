<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index(Request $request): View
    {
        $clientes = $this->clienteService->getPaginatedClientes(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        try {
            $cliente = $this->clienteService->createCliente($request->validated());

            return redirect()->route('clientes.index')
                ->with('success', "Cliente '{$cliente->name}' creado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el cliente: ' . $e->getMessage());
        }
    }

    public function show(ClienteModel $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(ClienteModel $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, ClienteModel $cliente): RedirectResponse
    {
        try {
            $updatedCliente = $this->clienteService->updateCliente($cliente, $request->validated());

            return redirect()->route('clientes.index')
                ->with('success', "Cliente '{$updatedCliente->name}' actualizado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el cliente: ' . $e->getMessage());
        }
    }

    public function destroy(ClienteModel $cliente): RedirectResponse
    {
        try {
            $clienteName = $cliente->name;
            $this->clienteService->deleteCliente($cliente);

            return redirect()->route('clientes.index')
                ->with('success', "Cliente '{$clienteName}' eliminado exitosamente.");
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el cliente: ' . $e->getMessage());
        }
    }
}
