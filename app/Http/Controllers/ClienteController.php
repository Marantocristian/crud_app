<?php

namespace App\Http\Controllers;

use App\Models\ClienteModel;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClienteController extends Controller
{
    public function index(): View
    {
        $clientes = ClienteModel::latest()->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(StoreClienteRequest $request): RedirectResponse
    {
        $cliente = ClienteModel::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', "Cliente {$cliente->nombre_completo} creado exitosamente.");
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
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', "Cliente {$cliente->nombre_completo} actualizado exitosamente.");
    }

    public function destroy(ClienteModel $cliente): RedirectResponse
    {
        $clienteName = $cliente->nombre_completo;
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', "Cliente {$clienteName} eliminado exitosamente.");
    }
}
