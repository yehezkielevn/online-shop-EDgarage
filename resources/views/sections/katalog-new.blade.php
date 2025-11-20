<section id="katalog" class="py-16 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10 text-center">
            <h2 class="text-4xl font-bold text-white">Katalog Motor</h2>
            <p class="text-gray-400 mt-2">Motor bekas berkualitas pilihan kami</p>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('home') }}#katalog" class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari motor..."
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg"
                >

                <select name="merek" class="bg-gray-800 text-white px-4 py-2 rounded-lg">
                    <option value="">Semua Merk</option>
                    @foreach($brands as $b)
                        <option value="{{ $b }}" {{ request('merek') == $b ? 'selected' : '' }}>
                            {{ $b }}
                        </option>
                    @endforeach
                </select>

                <select name="tipe" class="bg-gray-800 text-white px-4 py-2 rounded-lg">
                    <option value="">Semua Tipe</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}" {{ request('tipe') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun" class="bg-gray-800 text-white px-4 py-2 rounded-lg">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>

            </div>

            <div class="mt-4 flex gap-3">
                <button type="submit" class="bg-red-600 px-6 py-2 rounded-lg text-white">
                    Terapkan
                </button>

                <a href="{{ route('home') }}#katalog" class="text-gray-400 underline">
                    Reset
                </a>
            </div>
        </form>

        {{-- Grid Katalog --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @php
                $items = $products ?? $motors ?? collect();
            @endphp

            @forelse($items as $item)
                @include('katalog._card', ['item' => $item])
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-400 text-lg">Tidak ada produk ditemukan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>
