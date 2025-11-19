@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Katalog Motor</h1>
        <p class="text-sm text-gray-500">Temukan motor sesuai keinginan Anda</p>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('katalog.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Brand</label>
                <select name="brand" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500">
                    <option value="">Semua</option>
                    @foreach($brands as $b)
                        <option value="{{ $b }}" {{ request('brand') === $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga Min</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga Max</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" name="year" value="{{ request('year') }}" placeholder="2023" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sort</label>
                <select name="sort" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-2 focus:ring-red-500">
                    <option value="" {{ request('sort')=='' ? 'selected' : '' }}>Default</option>
                    <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low → High</option>
                    <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                    <option value="year_desc" {{ request('sort')=='year_desc' ? 'selected' : '' }}>Year: New → Old</option>
                    <option value="year_asc" {{ request('sort')=='year_asc' ? 'selected' : '' }}>Year: Old → New</option>
                </select>
            </div>
        </div>

        <div class="mt-4 flex items-center space-x-2">
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Terapkan</button>
            <a href="{{ route('katalog.index') }}" class="text-sm text-gray-600 hover:underline">Reset</a>
        </div>
    </form>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($motors as $motor)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow overflow-hidden">
                <div class="h-44 w-full bg-gray-100">
                    <img src="{{ $motor->image_url ?? 'https://picsum.photos/seed/motor'.$motor->id.'/800/600' }}" alt="{{ $motor->name }}" class="w-full h-full object-cover rounded-t-xl">
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $motor->name }}</h3>
                    <div class="mt-2 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <div>{{ $motor->brand }}</div>
                            <div class="text-xs">Tahun: {{ $motor->year }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-gray-900">Rp {{ number_format($motor->price, 0, ',', '.') }}</div>
                            <a href="{{ route('katalog.show', $motor) }}" class="mt-2 inline-block bg-red-600 text-white px-3 py-1 rounded-md text-sm hover:bg-red-700">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">Tidak ada motor ditemukan.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $motors->links() }}
    </div>
</div>
@endsection
