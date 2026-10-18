<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VentaController extends Controller
{
    public function index()
    {
        return view('ventas', [
            'ventas' => Venta::with(['cliente', 'detalles.producto'])->latest()->get(),
            'clientes' => Cliente::orderBy('nombre')->get(),
            'productos' => Producto::orderBy('producto')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        DB::transaction(function () use ($data): void {
            $venta = Venta::create([
                'cliente_id' => $data['cliente_id'],
                'fecha_venta' => $data['fecha_venta'],
                'estado' => $data['estado'],
                'total' => 0,
            ]);

            $this->replaceDetails($venta, $data['detalles'], $data['estado'] !== 'cancelada');
        });

        return to_route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function update(Request $request, Venta $venta)
    {
        $data = $this->validated($request);

        DB::transaction(function () use ($data, $venta): void {
            $venta->load('detalles');
            $this->restoreStock($venta);
            $venta->update([
                'cliente_id' => $data['cliente_id'],
                'fecha_venta' => $data['fecha_venta'],
                'estado' => $data['estado'],
            ]);
            $venta->detalles()->delete();
            $this->replaceDetails($venta, $data['detalles'], $data['estado'] !== 'cancelada');
        });

        return to_route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        if ($venta->estado === 'confirmada') {
            return to_route('ventas.index')->with('error', 'Solo se pueden eliminar ventas pendientes o canceladas.');
        }

        DB::transaction(function () use ($venta): void {
            $venta->load('detalles');
            $this->restoreStock($venta);
            $venta->delete();
        });

        return to_route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'fecha_venta' => ['required', 'date'],
            'estado' => ['required', 'in:pendiente,confirmada,cancelada'],
            'detalles' => ['required', 'array', 'min:1'],
            'detalles.*.producto_id' => ['required', 'distinct', 'exists:productos,id'],
            'detalles.*.cantidad' => ['required', 'integer', 'min:1'],
        ]);
    }

    private function replaceDetails(Venta $venta, array $details, bool $reserveStock): void
    {
        $total = 0;

        foreach ($details as $detail) {
            $producto = Producto::whereKey($detail['producto_id'])->lockForUpdate()->firstOrFail();
            $cantidad = (int) $detail['cantidad'];

            if ($reserveStock && $producto->stock < $cantidad) {
                throw ValidationException::withMessages([
                    'detalles' => "El producto {$producto->producto} no tiene stock suficiente.",
                ]);
            }

            if ($reserveStock) {
                $producto->decrement('stock', $cantidad);
            }

            $lineTotal = $cantidad * (float) $producto->precio;
            $venta->detalles()->create([
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'total' => $lineTotal,
            ]);
            $total += $lineTotal;
        }

        $venta->update(['total' => $total]);
    }

    private function restoreStock(Venta $venta): void
    {
        if ($venta->estado === 'cancelada') {
            return;
        }

        foreach ($venta->detalles as $detalle) {
            Producto::whereKey($detalle->producto_id)->lockForUpdate()->increment('stock', $detalle->cantidad);
        }
    }
}
