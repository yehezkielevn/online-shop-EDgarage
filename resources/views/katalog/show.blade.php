@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-dark-bg text-white py-10">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <a href="{{ route('katalog.index') }}" class="text-sm text-muted hover:underline">&larr; Kembali ke Katalog</a>

    <div class="mt-4 bg-card-bg rounded-xl shadow overflow-hidden">
      <div class="md:flex">
        <div class="md:w-1/2 h-80 bg-gray-800">
          <img src="{{ $motor->image_url ?? 'https://picsum.photos/seed/motor'.$motor->id.'/1200/800' }}" alt="{{ $motor->name }}" class="w-full h-full object-cover">
        </div>

        <div class="md:w-1/2 p-6">
          <h1 class="text-2xl font-bold text-white">{{ $motor->name }}</h1>
          <p class="text-sm text-muted mt-1">{{ $motor->brand }} • Tahun {{ $motor->year }}</p>

          <div class="mt-4">
            <div class="text-3xl font-extrabold text-primary">Rp {{ number_format($motor->price, 0, ',', '.') }}</div>
            <div class="text-sm text-muted mt-1">{{ number_format($motor->kilometer ?? 0, 0, ',', '.') }} km • {{ $motor->fuel ?? '-' }}</div>
          </div>

          @if($motor->description)
            <div class="mt-4 text-muted">{{ $motor->description }}</div>
          @endif

          <div class="mt-6 flex gap-3">
            <a href="#" class="inline-block bg-primary text-white px-5 py-2 rounded-lg hover:opacity-95">Hubungi Penjual</a>
            <a href="#" class="inline-block border border-gray-700 text-white px-5 py-2 rounded-lg hover:bg-gray-800">Tanya Lebih Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
