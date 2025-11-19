@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('katalog.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Kembali ke Katalog</a>

    <div class="mt-4 bg-white rounded-xl shadow overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2 h-80 bg-gray-100">
                <img src="{{ $motor->image_url ?? 'https://picsum.photos/seed/motor'.$motor->id.'/1200/800' }}" alt="{{ $motor->name }}" class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 p-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ $motor->name }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $motor->brand }} • Tahun {{ $motor->year }}</p>

                <div class="mt-4">
                    <div class="text-3xl font-extrabold text-gray-900">Rp {{ number_format($motor->price, 0, ',', '.') }}</div>
                </div>

                @if($motor->description ?? false)
                    <div class="mt-4 text-gray-700">{{ $motor->description }}</div>
                @endif

                <div class="mt-6">
                    <a href="#" class="inline-block bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-700">Hubungi Penjual</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
