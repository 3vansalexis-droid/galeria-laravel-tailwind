<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Categorías</title>
</head>
<body>
    <x-navbar />

    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Categorías</h1>
            <x-createCategoria />
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->categoria }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editCategoriaModal{{ $categoria->id }}">
                                    Actualizar
                                </button>
                                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('¿Quieres eliminar esta categoría?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay categorías registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @foreach ($categorias as $categoria)
            <div class="modal fade" id="editCategoriaModal{{ $categoria->id }}" tabindex="-1"
                aria-labelledby="editCategoriaModalLabel{{ $categoria->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="editCategoriaModalLabel{{ $categoria->id }}">
                                    Actualizar categoría
                                </h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <label for="categoria{{ $categoria->id }}" class="form-label">
                                    Nombre de la categoría
                                </label>
                                <input id="categoria{{ $categoria->id }}" name="categoria" class="form-control"
                                    type="text" value="{{ $categoria->categoria }}" required maxlength="255">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
</body>
</html>
