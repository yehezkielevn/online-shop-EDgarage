@php
    $heroImage = file_exists(public_path('images/motor.jpg'))
        ? asset('images/motor.jpg')
        : 'https://images.unsplash.com/photo-1558980664-769d59546b3d?auto=format&fit=crop&w=2100&q=80';
@endphp

<section id="hero"
    class="h-screen w-full bg-cover bg-center relative flex items-center justify-center"
    style="background-image: url('{{ $heroImage }}');">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 text-center max-w-3xl px-6 animate-fadeIn">

        <h1 class="text-5xl md:text-7xl font-extrabold mb-4 tracking-tight">
            <span class="text-red-600 drop-shadow-lg">E&D</span><span class="text-white drop-shadow-lg">garage</span>
        </h1>

        <p class="text-gray-200 text-lg md:text-xl font-medium mb-8 drop-shadow-md">
            Tempat terbaik membeli motor bekas berkualitas<br>dengan harga terjangkau dan terpercaya.
        </p>

        <a href="#katalog"
            class="inline-block px-8 py-4 rounded-full bg-red-600 text-white font-bold text-lg hover:bg-red-700 transition transform hover:scale-105 shadow-lg hover:shadow-red-900/50">
            Lihat Stok Motor
        </a>

    </div>

</section>

<style>
    .animate-fadeIn { animation: fadeIn 1s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>