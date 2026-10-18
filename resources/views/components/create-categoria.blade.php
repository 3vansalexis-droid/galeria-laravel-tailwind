<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoriaModal">
    Nueva categoría
</button>

<div class="modal fade" id="createCategoriaModal" tabindex="-1" aria-labelledby="createCategoriaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="createCategoriaModalLabel">Registrar categoría</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <label for="nuevaCategoria" class="form-label">Nombre de la categoría</label>
                    <input id="nuevaCategoria" name="categoria" class="form-control" type="text"
                        value="{{ old('categoria') }}" placeholder="Ingresa el nombre de la categoría" required
                        maxlength="255">
                    @error('categoria')
                        <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
