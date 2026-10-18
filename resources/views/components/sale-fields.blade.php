<div class="row mb-3"><div class="col"><label class="form-label">Cliente</label><select class="form-select" name="cliente_id" required><option value="">Seleccione</option>@foreach ($clientes as $cliente)<option value="{{ $cliente->id }}" @selected(old('cliente_id', $venta->cliente_id ?? '') == $cliente->id)>{{ $cliente->nombre }}</option>@endforeach</select></div>
<div class="col"><label class="form-label">Fecha</label><input class="form-control" type="date" name="fecha_venta" value="{{ old('fecha_venta', isset($venta) ? $venta->fecha_venta->format('Y-m-d') : now()->format('Y-m-d')) }}" required></div>
<div class="col"><label class="form-label">Estado</label><select class="form-select" name="estado" required>@foreach (['pendiente','confirmada','cancelada'] as $estado)<option value="{{ $estado }}" @selected(old('estado', $venta->estado ?? 'pendiente') === $estado)>{{ ucfirst($estado) }}</option>@endforeach</select></div></div>
<label class="form-label">Productos</label><div data-sale-lines>
@if (isset($venta))
@foreach ($venta->detalles as $index => $detalle)<div class="row g-2 mb-2 sale-line"><div class="col"><select class="form-select" name="detalles[{{ $index }}][producto_id]" required>@foreach ($productos as $producto)<option value="{{ $producto->id }}" @selected($detalle->producto_id === $producto->id)>{{ $producto->producto }} (stock: {{ $producto->stock }})</option>@endforeach</select></div><div class="col-3"><input class="form-control" type="number" min="1" name="detalles[{{ $index }}][cantidad]" value="{{ $detalle->cantidad }}" required></div><div class="col-auto"><button type="button" class="btn btn-outline-danger" onclick="removeSaleLine(this)">Quitar</button></div></div>@endforeach
@else
<div class="row g-2 mb-2 sale-line"><div class="col"><select class="form-select" name="detalles[0][producto_id]" required><option value="">Seleccione</option>@foreach ($productos as $producto)<option value="{{ $producto->id }}">{{ $producto->producto }} (stock: {{ $producto->stock }})</option>@endforeach</select></div><div class="col-3"><input class="form-control" type="number" min="1" name="detalles[0][cantidad]" value="1" required></div><div class="col-auto"><button type="button" class="btn btn-outline-danger" onclick="removeSaleLine(this)">Quitar</button></div></div>
@endif
</div><button type="button" class="btn btn-outline-secondary btn-sm" onclick="addSaleLine(this)">Agregar producto</button>
<template><div class="row g-2 mb-2 sale-line"><div class="col"><select class="form-select" name="detalles[__INDEX__][producto_id]" required><option value="">Seleccione</option>@foreach ($productos as $producto)<option value="{{ $producto->id }}">{{ $producto->producto }} (stock: {{ $producto->stock }})</option>@endforeach</select></div><div class="col-3"><input class="form-control" type="number" min="1" name="detalles[__INDEX__][cantidad]" value="1" required></div><div class="col-auto"><button type="button" class="btn btn-outline-danger" onclick="removeSaleLine(this)">Quitar</button></div></div></template>
<script>
function addSaleLine(button) {
    const form = button.closest('form');
    const lineIndex = Number(form.dataset.saleLineIndex || form.querySelectorAll('.sale-line').length);
    const html = form.querySelector('template').innerHTML.replaceAll('__INDEX__', lineIndex);
    form.dataset.saleLineIndex = lineIndex + 1;
    form.querySelector('[data-sale-lines]').insertAdjacentHTML('beforeend', html);
}
function removeSaleLine(button) { button.closest('.sale-line').remove(); }
</script>
