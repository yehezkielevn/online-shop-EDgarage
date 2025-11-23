@extends('layouts.app')

@section('content')
    <div class="pt-24 pb-6 bg-black">
        <div class="max-w-7xl mx-auto px-6">
            <a href="/#katalog" class="inline-flex items-center text-gray-400 hover:text-white transition mb-6 group">
                <svg width="20" height="20" class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Katalog
            </a>
        </div>
    </div>

    <section class="bg-black min-h-screen pb-20 text-white">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <div>
                    @php
                        $images = $product->gambar ?? [];
                        if (count($images) == 0) $images = ['no-image.png']; 
                    @endphp

                    <div class="relative h-[400px] md:h-[500px] bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 group mb-4">
                        <img id="mainImage" 
                             src="{{ str_contains($images[0], 'no-image') ? asset('images/no-image.png') : asset('storage/' . $images[0]) }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                             alt="{{ $product->nama_motor }}">

                        @if(count($images) > 1)
                            <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 hover:bg-red-600 text-white rounded-full flex items-center justify-center backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
                                <svg width="24" height="24" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 hover:bg-red-600 text-white rounded-full flex items-center justify-center backdrop-blur-sm transition opacity-0 group-hover:opacity-100">
                                <svg width="24" height="24" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                            <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded-full border border-white/10">
                                <span id="currentIndex">1</span> / {{ count($images) }}
                            </div>
                        @endif

                        <div class="absolute top-4 left-4">
                            <span class="bg-red-600 text-white px-3 py-1 rounded-md text-xs font-bold shadow-lg uppercase tracking-wider">
                                {{ $product->tipe }}
                            </span>
                        </div>
                    </div>

                    @if(count($images) > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach($images as $index => $img)
                                <button onclick="selectImage({{ $index }})" 
                                        class="thumbnail-btn relative h-24 w-full rounded-xl overflow-hidden border-2 transition-all duration-300 {{ $index === 0 ? 'border-red-600 opacity-100' : 'border-transparent opacity-60 hover:opacity-100' }}"
                                        id="thumb-{{ $index }}">
                                    <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2 text-white">{{ $product->nama_motor }}</h1>
                    <p class="text-3xl font-bold text-red-600 mb-8">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-6">
                        <h3 class="text-lg font-semibold mb-6 text-gray-200">Spesifikasi</h3>
                        
                        <div class="grid grid-cols-2 gap-y-8 gap-x-4 border-b border-gray-800 pb-8 mb-6">
                            
                            <div class="flex items-start">
                                <div class="p-2.5 rounded-lg border border-gray-700 text-red-500 mr-4 bg-gray-800/50 shrink-0">
                                    <svg width="20" height="20" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Tahun</p>
                                    <p class="text-lg font-bold text-white">{{ $product->tahun }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2.5 rounded-lg border border-gray-700 text-red-500 mr-4 bg-gray-800/50 shrink-0">
                                    <svg width="20" height="20" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Kilometer</p>
                                    <p class="text-lg font-bold text-white">{{ number_format($product->kilometer) }} km</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2.5 rounded-lg border border-gray-700 text-red-500 mr-4 bg-gray-800/50 shrink-0">
                                    <svg width="20" height="20" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Warna</p>
                                    <p class="text-lg font-bold text-white">{{ $product->warna }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="p-2.5 rounded-lg border border-gray-700 text-red-500 mr-4 bg-gray-800/50 shrink-0">
                                    <svg width="20" height="20" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-1">Plat Nomor</p>
                                    <p class="text-lg font-bold text-white">{{ $product->plat_nomor ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-4 font-semibold">LEGALITAS</p>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-3">
                                    @if($product->status_surat != 'Non Surat')
                                        <svg width="20" height="20" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white font-medium">{{ $product->status_surat }}</span>
                                    @else
                                        <svg width="20" height="20" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white font-medium">Non Surat / Bodong</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3">
                                    @if($product->status_pajak == 'Hidup')
                                        <svg width="20" height="20" class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white font-medium">Pajak: <span class="text-green-400">Hidup</span></span>
                                    @else
                                        <svg width="20" height="20" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <span class="text-white font-medium">Pajak: <span class="text-red-400">Mati</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 mb-8">
                        <div class="flex items-center gap-2 mb-3">
                            <svg width="20" height="20" class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="text-lg font-semibold text-gray-200">Kondisi / Catatan</h3>
                        </div>
                        <p class="text-gray-400 leading-relaxed text-sm">
                            {{ $product->minus ?? 'Tidak ada catatan khusus. Kondisi motor sangat baik dan siap pakai.' }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-4">
                        
                        @php
                            $pesan = "Halo Admin E&Dgarage, saya tertarik dengan motor *{$product->nama_motor}* (Rp " . number_format($product->harga,0,',','.') . "). Apakah unit masih tersedia?";
                            $waLink = "https://wa.me/6281234567890?text=" . urlencode($pesan); 
                        @endphp
                        
                        <a href="{{ $waLink }}" target="_blank" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-900/20 transition transform hover:scale-[1.02] flex items-center justify-center gap-2">
                            <svg width="24" height="24" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            Hubungi Penjual via WhatsApp
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        const productImages = @json($images);
        let currentIndex = 0;

        function changeImage(src) {
            const mainImage = document.getElementById('mainImage');
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = 1;
            }, 200);
        }

        function selectImage(index) {
            currentIndex = index;
            const src = "{{ asset('storage/') }}/" + productImages[index];
            changeImage(src);
            
            document.querySelectorAll('.thumbnail-btn').forEach((btn, idx) => {
                if (idx === index) {
                    btn.classList.remove('border-transparent', 'opacity-60');
                    btn.classList.add('border-red-600', 'opacity-100');
                } else {
                    btn.classList.add('border-transparent', 'opacity-60');
                    btn.classList.remove('border-red-600', 'opacity-100');
                }
            });

            const counter = document.getElementById('currentIndex');
            if(counter) counter.innerText = index + 1;
        }

        function nextImage() {
            let newIndex = currentIndex + 1;
            if (newIndex >= productImages.length) newIndex = 0;
            selectImage(newIndex);
        }

        function prevImage() {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) newIndex = productImages.length - 1;
            selectImage(newIndex);
        }
    </script>
@endsection