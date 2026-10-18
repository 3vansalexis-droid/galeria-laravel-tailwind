<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Administración</title>
</head>
<body>
    <x-navbar />

    <main class="container py-5">
        <div class="text-center mb-5">
            <h1>Panel de administración</h1>
            <p class="lead">Administra los productos, clientes, ventas y categorías del sistema.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('productos.index') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h2 class="h4">Productos</h2>
                            <p class="text-muted mb-0">Registrar, actualizar y eliminar productos.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('clientes.index') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h2 class="h4">Clientes</h2>
                            <p class="text-muted mb-0">Administrar la información de los clientes.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('ventas.index') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h2 class="h4">Ventas</h2>
                            <p class="text-muted mb-0">Registrar ventas y controlar el stock.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('categorias.index') }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <h2 class="h4">Categorías</h2>
                            <p class="text-muted mb-0">Organizar las categorías de productos.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
