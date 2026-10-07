# Galería Laravel + Tailwind

Práctica de diseño responsive realizada con Laravel, Blade y Tailwind CSS.

## Características

- Galería con seis tarjetas de imágenes.
- Diseño responsive para móvil, tablet y escritorio.
- Navbar adaptable con menú móvil.
- Imágenes con texto alternativo y carga diferida.
- Efectos visuales con clases utilitarias de Tailwind CSS.

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm

## Instalación

```bash
git clone https://github.com/3vansalexis-droid/galeria-laravel-tailwind.git
cd galeria-laravel-tailwind
composer install
npm install
copy .env.example .env
php artisan key:generate
```

## Ejecución

En una terminal:

```bash
php artisan serve
```

En otra terminal:

```bash
npm run dev
```

Después visita `http://127.0.0.1:8000`.

## Archivos principales

- `resources/views/welcome.blade.php`: estructura de la galería.
- `resources/css/app.css`: configuración de Tailwind CSS.
- `routes/web.php`: ruta principal de la aplicación.
