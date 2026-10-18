<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">@vite(['resources/css/app.css','resources/js/app.js'])<title>Clientes</title></head>
<body><x-navbar /><main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3"><h1>Clientes</h1><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal">Registrar cliente</button></div>
    @include('components.alerts')
    <div class="table-responsive"><table class="table table-bordered align-middle"><thead class="table-info"><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Dirección</th><th>Teléfono</th><th>Acciones</th></tr></thead><tbody>
    @forelse ($clientes as $cliente)
        <tr><td>{{ $cliente->id }}</td><td>{{ $cliente->nombre }}</td><td>{{ $cliente->email }}</td><td>{{ $cliente->direccion }}</td><td>{{ $cliente->telefono }}</td><td>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarCliente{{ $cliente->id }}">Actualizar</button>
            <form class="d-inline" method="POST" action="{{ route('clientes.destroy', $cliente) }}" onsubmit="return confirm('¿Eliminar cliente?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Eliminar</button></form>
        </td></tr>
    @empty <tr><td colspan="6" class="text-center">No hay clientes registrados.</td></tr>@endforelse
    </tbody></table></div>
</main>
@foreach ($clientes as $cliente)
<div class="modal fade" id="editarCliente{{ $cliente->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="{{ route('clientes.update', $cliente) }}">@csrf @method('PUT')
    <div class="modal-header"><h2 class="modal-title fs-5">Actualizar cliente</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">@include('components.client-fields', ['cliente' => $cliente])</div><div class="modal-footer"><button class="btn btn-success">Guardar cambios</button></div>
</form></div></div></div>
@endforeach
<div class="modal fade" id="clienteModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="{{ route('clientes.store') }}">@csrf
    <div class="modal-header"><h2 class="modal-title fs-5">Registrar cliente</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">@include('components.client-fields')</div><div class="modal-footer"><button class="btn btn-primary">Guardar</button></div>
</form></div></div></div>
</body></html>
