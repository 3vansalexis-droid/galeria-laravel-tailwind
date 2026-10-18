<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('clientes', ['clientes' => Cliente::latest()->get()]);
    }

    public function store(Request $request)
    {
        Cliente::create($this->validated($request));

        return to_route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    public function update(Request $request, Cliente $cliente)
    {
        Cliente::whereKey($cliente->id)->update($this->validated($request, $cliente));

        return to_route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->ventas()->exists()) {
            return to_route('clientes.index')->with('error', 'No se puede eliminar un cliente con ventas registradas.');
        }

        $cliente->delete();

        return to_route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    private function validated(Request $request, ?Cliente $cliente = null): array
    {
        $emailRule = 'unique:clientes,email';
        if ($cliente) {
            $emailRule .= ',' . $cliente->id;
        }

        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $emailRule],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:30'],
        ]);
    }
}
