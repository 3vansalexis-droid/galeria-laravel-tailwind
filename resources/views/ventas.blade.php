<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">@vite(['resources/css/app.css','resources/js/app.js'])<title>Ventas</title></head>
<body><x-navbar /><main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3"><h1>Ventas</h1><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ventaModal">Registrar venta</button></div>
    @include('components.alerts')
    <div class="table-responsive"><table class="table table-bordered align-middle"><thead class="table-info"><tr><th>ID</th><th>Cliente</th><th>Fecha</th><th>Estado</th><th>Detalle</th><th>Total</th><th>Acciones</th></tr></thead><tbody>
    @forelse ($ventas as $venta)
        <tr><td>{{ $venta->id }}</td><td>{{ $venta->cliente->nombre }}</td><td>{{ $venta->fecha_venta->format('Y-m-d') }}</td><td>{{ ucfirst($venta->estado) }}</td><td>@foreach ($venta->detalles as $detalle){{ $detalle->producto->producto }} ({{ $detalle->cantidad }})@if (!$loop->last), @endif @endforeach</td><td>${{ number_format($venta->total, 2) }}</td><td>
            @if ($venta->estado !== 'confirmada')<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarVenta{{ $venta->id }}">Actualizar</button><form class="d-inline" method="POST" action="{{ route('ventas.destroy', $venta) }}" onsubmit="return confirm('¿Eliminar venta?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Eliminar</button></form>@endif
        </td></tr>
    @empty <tr><td colspan="7" class="text-center">No hay ventas registradas.</td></tr>@endforelse
    </tbody></table></div>
</main>
@foreach ($ventas as $venta)
@if ($venta->estado !== 'confirmada')
<div class="modal fade" id="editarVenta{{ $venta->id }}" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST" action="{{ route('ventas.update', $venta) }}">@csrf @method('PUT')
<div class="modal-header"><h2 class="modal-title fs-5">Actualizar venta</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">@include('components.sale-fields', ['venta' => $venta])</div><div class="modal-footer"><button class="btn btn-success">Guardar cambios</button></div>
</form></div></div></div>
@endif
@endforeach
<div class="modal fade" id="ventaModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST" action="{{ route('ventas.store') }}">@csrf
<div class="modal-header"><h2 class="modal-title fs-5">Registrar venta</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body">@include('components.sale-fields')</div><div class="modal-footer"><button class="btn btn-primary">Guardar</button></div>
</form></div></div></div>
</body></html>
