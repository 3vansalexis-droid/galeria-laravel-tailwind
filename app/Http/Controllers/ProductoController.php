<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return view('productos', [
            'productos' => Producto::with('categoria')->latest()->get(),
            'categorias' => Categoria::orderBy('categoria')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Producto::create($this->validated($request));

        return to_route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($this->validated($request));

        return to_route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->detallesVenta()->exists()) {
            return to_route('productos.index')
                ->with('error', 'No se puede eliminar un producto que aparece en ventas.');
        }

        $producto->delete();

        return to_route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'producto' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categoria,id'],
        ]);
    }
}
