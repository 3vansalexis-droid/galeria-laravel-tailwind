<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Productos</title>
</head>
<body>
<x-navbar />
<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Productos</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal">Registrar producto</button>
    </div>
    @include('components.alerts')
    <div class="table-responsive"><table class="table table-bordered align-middle">
        <thead class="table-info"><tr><th>ID</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr></thead>
        <tbody>
        @forelse ($productos as $producto)
            <tr><td>{{ $producto->id }}</td><td>{{ $producto->producto }}</td><td>{{ $producto->categoria->categoria }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td><td>{{ $producto->stock }}</td><td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarProducto{{ $producto->id }}">Actualizar</button>
                    <form class="d-inline" method="POST" action="{{ route('productos.destroy', $producto) }}" onsubmit="return confirm('¿Eliminar producto?')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Eliminar</button></form>
                </td></tr>
        @empty <tr><td colspan="6" class="text-center">No hay productos registrados.</td></tr>
        @endforelse
        </tbody>
    </table></div>
</main>
@foreach ($productos as $producto)
<div class="modal fade" id="editarProducto{{ $producto->id }}" tabindex="-1"><div class="modal-dialog"><div class="modal-content">
    <form method="POST" action="{{ route('productos.update', $producto) }}">@csrf @method('PUT')
        <div class="modal-header"><h2 class="modal-title fs-5">Actualizar producto</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">@include('components.product-fields', ['producto' => $producto])</div>
        <div class="modal-footer"><button type="submit" class="btn btn-success">Guardar cambios</button></div>
    </form>
</div></div></div>
@endforeach
<div class="modal fade" id="productoModal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="{{ route('productos.store') }}">@csrf
    <div class="modal-header"><h2 class="modal-title fs-5">Registrar producto</h2><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body">@include('components.product-fields')</div><div class="modal-footer"><button class="btn btn-primary">Guardar</button></div>
</form></div></div></div>
</body>
</html>
