@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-white">

    <h1 class="text-3xl font-bold mb-2">Katalog Motor</h1>
    <p class="text-gray-400 mb-8">Cari dan temukan motor bekas berkualitas tinggi.</p>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('katalog.index') }}" class="space-y-4 mb-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Search -->
            <input 
                type="text" 
                name="q" 
                value="{{ request('q') }}" 
                placeholder="Cari nama motor / merek..."
                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-500"
            >

            <!-- Brand -->
            <select name="brand" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2.5">
                <option value="">Semua Merek</option>
                @foreach($brands as $b)
                    <option value="{{ $b }}" {{ request('brand') == $b ? 'selected' : '' }}>
                        {{ $b }}
                    </option>
                @endforeach
            </select>

            <!-- Type -->
<select name="tipe" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2.5">
    <option value="">Semua Tipe</option>
    @foreach($types as $t)
        <option value="{{ $t }}" {{ request('tipe') == $t ? 'selected' : '' }}>
            {{ ucfirst($t) }}
        </option>
    @endforeach
</select>


            <!-- Year -->
            <select name="year" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-2.5">
                <option value="">Semua Tahun</option>
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="flex items-center gap-4">
            <button class="bg-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-700">
                Terapkan
            </button>
            <a href="{{ route('katalog.index') }}" class="text-gray-400 hover:text-gray-200">
                Reset
            </a>
        </div>

    </form>

    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            @include('katalog._card', ['product' => $product])
        @empty
            <p class="text-gray-400 col-span-full text-center py-10">Tidak ada motor ditemukan.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $products->withQueryString()->links() }}
    </div>

</div>

@endsection
