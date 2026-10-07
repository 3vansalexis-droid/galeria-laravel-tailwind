<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Galería de paisajes y lugares para descubrir.">

        <title>Galería</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <header class="bg-slate-950 text-white shadow-lg">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8" aria-label="Navegación principal">
                <a href="/" class="text-2xl font-bold tracking-tight sm:text-3xl">Galería</a>

                <div class="hidden items-center gap-8 text-base font-semibold md:flex">
                    <a href="#inicio" class="transition hover:text-slate-300">Inicio</a>
                    <a href="#galeria" class="transition hover:text-slate-300">Galería</a>
                    <a href="#nosotros" class="transition hover:text-slate-300">Nosotros</a>
                    <a href="#contacto" class="transition hover:text-slate-300">Contacto</a>
                </div>

                <details class="relative md:hidden">
                    <summary class="list-none cursor-pointer rounded-md p-1 text-3xl leading-none" aria-label="Abrir menú">
                        <span aria-hidden="true">☰</span>
                    </summary>
                    <div class="absolute right-0 top-12 z-10 min-w-40 rounded-lg bg-white p-3 text-right text-base font-semibold text-slate-900 shadow-xl">
                        <a href="#inicio" class="block rounded px-3 py-2 hover:bg-slate-100">Inicio</a>
                        <a href="#galeria" class="block rounded px-3 py-2 hover:bg-slate-100">Galería</a>
                        <a href="#nosotros" class="block rounded px-3 py-2 hover:bg-slate-100">Nosotros</a>
                        <a href="#contacto" class="block rounded px-3 py-2 hover:bg-slate-100">Contacto</a>
                    </div>
                </details>
            </nav>
        </header>

        <main id="inicio" class="mx-auto max-w-7xl px-6 py-12 sm:py-16 lg:px-8 lg:py-20">
            <section id="galeria" aria-labelledby="gallery-title">
                <h1 id="gallery-title" class="mb-10 text-center text-4xl font-bold tracking-tight sm:mb-12 sm:text-5xl lg:text-6xl">
                    Nuestra Galería
                </h1>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
                    @php
                        $photos = [
                            [
                                'title' => 'Paisaje Natural',
                                'description' => 'Una hermosa vista de la naturaleza.',
                                'image' => 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1200&q=85',
                            ],
                            [
                                'title' => 'Montañas',
                                'description' => 'Paisajes increíbles rodeados de montañas.',
                                'image' => 'https://images.unsplash.com/photo-1464278533981-50106e6176b1?auto=format&fit=crop&w=1200&q=85',
                            ],
                            [
                                'title' => 'Bosque',
                                'description' => 'Un tranquilo bosque rodeado de naturaleza.',
                                'image' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=1200&q=85',
                            ],
                            [
                                'title' => 'Playa',
                                'description' => 'Un lugar perfecto para descansar.',
                                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=85',
                            ],
                            [
                                'title' => 'Ciudad',
                                'description' => 'Arquitectura moderna en una gran ciudad.',
                                'image' => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?auto=format&fit=crop&w=1200&q=85',
                            ],
                            [
                                'title' => 'Aventura',
                                'description' => 'Explora nuevos lugares y vive nuevas experiencias.',
                                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=85',
                            ],
                        ];
                    @endphp

                    @foreach ($photos as $photo)
                        <article class="overflow-hidden rounded-2xl bg-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <img
                                src="{{ $photo['image'] }}"
                                alt="{{ $photo['title'] }}"
                                class="aspect-[4/3] w-full object-cover"
                                loading="lazy"
                            >
                            <div class="p-6">
                                <h2 class="text-xl font-bold sm:text-2xl">{{ $photo['title'] }}</h2>
                                <p class="mt-3 text-base leading-relaxed text-slate-600 sm:text-lg">{{ $photo['description'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="nosotros" class="sr-only" aria-label="Nosotros">
                Galería de paisajes naturales y destinos para descubrir.
            </section>
            <section id="contacto" class="sr-only" aria-label="Contacto">
                Contacto de la galería.
            </section>
        </main>
    </body>
</html>
