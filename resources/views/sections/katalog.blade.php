<section id="katalog" class="py-20 bg-black text-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="mb-10 text-center">
            <h2 class="text-4xl font-bold">Katalog Motor</h2>
            <p class="text-gray-400 mt-2">Motor bekas berkualitas pilihan</p>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            @forelse($motors as $motor)
                <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden hover:scale-105 transition-transform">

                    <img class="h-48 w-full object-cover"
                        src="{{ $motor->image_url ?? 'https://picsum.photos/seed/'.$motor->id.'/600/400' }}">

                    <div class="p-5 space-y-3">

                        <h3 class="text-xl font-bold">{{ $motor->name }}</h3>

                        <p class="text-gray-400 text-sm">
                            {{ $motor->brand }} - {{ $motor->year }}
                        </p>

                        <p class="text-red-500 text-lg font-bold">
                            Rp {{ number_format($motor->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('katalog.show', $motor) }}"
                            class="block text-center bg-red-600 hover:bg-red-700 py-2 rounded-lg font-semibold transition">
                            Detail
                        </a>

                    </div>

                </div>
            @empty

                <div class="col-span-full text-center py-20">
                    <p class="text-gray-400 text-lg">Belum ada motor tersedia.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>
