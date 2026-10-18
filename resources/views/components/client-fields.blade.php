<div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre ?? '') }}" required maxlength="255"></div>
<div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email', $cliente->email ?? '') }}" required maxlength="255"></div>
<div class="mb-3"><label class="form-label">Dirección</label><input class="form-control" name="direccion" value="{{ old('direccion', $cliente->direccion ?? '') }}" required maxlength="255"></div>
<div class="mb-3"><label class="form-label">Teléfono</label><input class="form-control" name="telefono" value="{{ old('telefono', $cliente->telefono ?? '') }}" required maxlength="30"></div>
