<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::query()->latest()->get();

        return view('categorias', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria' => ['required', 'string', 'max:255'],
        ]);

        Categoria::create($validated);

        return to_route('categorias.index')
            ->with('success', 'La categoría se creó correctamente.');
    }
    public function updateCategoria(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'categoria' => ['required', 'string', 'max:255'],
        ]);

        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('success', 'La categoría se actualizó correctamente.');
    }

    public function deleteCategoiria(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'La categoría se eliminó correctamente.');
    }
}