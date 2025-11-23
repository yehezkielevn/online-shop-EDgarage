<section id="katalog" class="py-20 bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-extrabold tracking-tight mb-4">
                <span class="text-red-600">Koleksi</span> Motor Pilihan
            </h2>
            <p class="text-gray-400 text-lg">Temukan motor impianmu dengan kualitas terbaik.</p>
        </div>

        <form method="GET" action="{{ url('/') }}#katalog" class="mb-12 p-6 bg-gray-800 rounded-2xl shadow-xl border border-gray-700">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <input type="text" name="search" placeholder="Cari nama motor..." value="{{ request('search') }}" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:border-red-600 outline-none">
                
                <select name="merek" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:border-red-600 outline-none">
                    <option value="">Semua Merek</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand }}" {{ request('merek') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>

                <select name="tahun" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:border-red-600 outline-none">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>

                <select name="tipe" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:border-red-600 outline-none">
                    <option value="">Semua Tipe</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('tipe') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4 flex justify-end gap-3">
                <a href="{{ url('/') }}#katalog" class="px-6 py-2 text-gray-400 hover:text-white transition font-medium flex items-center">
                    Reset
                </a>
                <button type="submit" class="px-8 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold transition shadow-lg">
                    Filter
                </button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($products as $product)
                <div class="bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-700 hover:border-red-600/50 transition-all duration-300 group flex flex-col h-full">
                    
                    <div class="relative h-64 bg-gray-700 overflow-hidden product-slider" id="slider-{{ $product->id }}">
                        
                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 bg-red-600/90 backdrop-blur text-white text-xs font-bold rounded-full uppercase shadow-sm">
                                {{ $product->tipe ?? 'Motor' }}
                            </span>
                        </div>

                        <div class="slider-wrapper flex h-full w-full transition-transform duration-500 ease-in-out">
                            @if($product->gambar && is_array($product->gambar) && count($product->gambar) > 0)
                                @foreach($product->gambar as $img)
                                    <img src="{{ asset('storage/'.$img) }}" class="h-full w-full object-cover flex-shrink-0" alt="{{ $product->nama_motor }}">
                                @endforeach
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-gray-800 text-gray-500 flex-shrink-0">
                                    No Image
                                </div>
                            @endif
                        </div>

                        @if($product->gambar && count($product->gambar) > 1)
                            <button onclick="moveSlide('{{ $product->id }}', -1)" class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white hover:bg-red-600 transition opacity-0 group-hover:opacity-100 z-20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>
                            <button onclick="moveSlide('{{ $product->id }}', 1)" class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white hover:bg-red-600 transition opacity-0 group-hover:opacity-100 z-20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                            
                            <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-1 z-10">
                                @foreach($product->gambar as $index => $img)
                                    <div class="w-2 h-2 rounded-full bg-white/50 transition-colors indicator-{{ $product->id }}" data-index="{{ $index }}"></div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-white line-clamp-1">{{ $product->nama_motor }}</h3>
                                <p class="text-sm text-gray-400 font-medium">{{ $product->merek }} &bull; {{ $product->tahun }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 my-4 text-sm text-gray-400 bg-gray-900/50 p-3 rounded-lg">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                <span>{{ number_format($product->kilometer) }} km</span>
                            </div>
                            <div class="w-px h-4 bg-gray-700"></div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ $product->status_pajak }}</span>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <p class="text-2xl font-bold text-red-500 mb-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('katalog.show', $product->id) }}" class="py-2.5 text-center rounded-lg border border-gray-600 hover:border-white text-gray-300 hover:text-white font-medium transition">
                                    Lihat Detail
                                </a>
                                
                                @php
                                    $pesan = "Halo, saya tertarik dengan {$product->nama_motor}.";
                                    $wa = "https://wa.me/6281234567890?text=" . urlencode($pesan);
                                @endphp
                                <a href="{{ $wa }}" target="_blank" class="py-2.5 text-center rounded-lg bg-red-600 hover:bg-red-700 text-white font-bold transition shadow-lg flex justify-center items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    Beli
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <p class="text-gray-400 text-xl font-medium">Belum ada motor yang tersedia saat ini.</p>
                </div>
            @endforelse

        </div>

        <div class="mt-16">
            {{ $products->links() }}
        </div>

    </div>
</section>

<script>
    const sliders = {};

    function initSlider(id, totalImages) {
        sliders[id] = { index: 0, total: totalImages, interval: null };
        updateSlide(id);
        startAutoSlide(id);
    }

    function moveSlide(id, step) {
        if (!sliders[id]) return;
        clearInterval(sliders[id].interval);
        sliders[id].index += step;
        if (sliders[id].index >= sliders[id].total) sliders[id].index = 0;
        if (sliders[id].index < 0) sliders[id].index = sliders[id].total - 1;
        updateSlide(id);
        startAutoSlide(id);
    }

    function updateSlide(id) {
        const wrapper = document.querySelector(`#slider-${id} .slider-wrapper`);
        const indicators = document.querySelectorAll(`.indicator-${id}`);
        if (wrapper) wrapper.style.transform = `translateX(-${sliders[id].index * 100}%)`;
        if (indicators.length > 0) {
            indicators.forEach((dot, idx) => {
                if (idx === sliders[id].index) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-red-600', 'w-4');
                } else {
                    dot.classList.add('bg-white/50');
                    dot.classList.remove('bg-red-600', 'w-4');
                }
            });
        }
    }

    function startAutoSlide(id) {
        sliders[id].interval = setInterval(() => {
            sliders[id].index++;
            if (sliders[id].index >= sliders[id].total) sliders[id].index = 0;
            updateSlide(id);
        }, 4000);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.product-slider').forEach(slider => {
            const id = slider.id.replace('slider-', '');
            const imagesCount = slider.querySelectorAll('img').length;
            if (imagesCount > 1) initSlider(id, imagesCount);
        });
    });
</script>