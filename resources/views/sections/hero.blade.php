@php
$heroImage = file_exists(public_path('images/motor.jpg'))
    ? asset('images/motor.jpg')
    : 'https://images.unsplash.com/photo-1558980664-769d59546b3d?auto=format&fit=crop&w=2100&q=80';
@endphp

<section id="hero"
    class="h-screen w-full bg-cover bg-center relative flex items-center justify-center"
    style="background-image: url('{{ $heroImage }}')">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 text-center max-w-3xl px-6">

        <h1 class="text-5xl md:text-7xl font-extrabold mb-4">
            <span class="text-red-600">E&D</span><span class="text-white">garage</span>
        </h1>

        <p class="text-gray-200 text-lg md:text-xl font-medium mb-8">
            Tempat terbaik membeli motor bekas berkualitas
        </p>

        <a href="#katalog"
            class="px-8 py-3 rounded-lg bg-red-600 text-white font-semibold text-lg hover:bg-red-700 transition">
            Lihat Stok Motor
        </a>

    </div>

</section>
