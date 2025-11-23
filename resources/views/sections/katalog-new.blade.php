<section id="katalog" class="py-20 bg-black text-white">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="mb-10 text-center">
            <h2 class="text-4xl font-bold">Katalog Motor</h2>
            <p class="text-gray-400 mt-2">Motor bekas berkualitas pilihan</p>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="#katalog" class="mb-10 p-6 bg-gray-900 rounded-lg filter-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Search -->
                <div>
                    <input type="text" name="search" placeholder="Cari motor..." value="{{ request('search') }}"
                        class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-red-600 focus:outline-none transition">
                </div>

                <!-- Merek -->
                <div>
                    <select name="merek" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-red-600 focus:outline-none transition">
                        <option value="">Semua Merek</option>
                        @foreach($brands ?? [] as $brand)
                            <option value="{{ $brand }}" {{ request('merek') === $brand ? 'selected' : '' }}>
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tahun -->
                <div>
                    <select name="tahun" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-red-600 focus:outline-none transition">
                        <option value="">Semua Tahun</option>
                        @foreach($years ?? [] as $year)
                            <option value="{{ $year }}" {{ request('tahun') === $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipe -->
                <div>
                    <select name="tipe" class="w-full px-4 py-2 bg-gray-800 border border-gray-700 rounded-lg text-white focus:border-red-600 focus:outline-none transition">
                        <option value="">Semua Tipe</option>
                        @foreach($types ?? [] as $type)
                            <option value="{{ $type }}" {{ request('tipe') === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-4 flex gap-3">
                <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 rounded-lg font-semibold transition">
                    Filter
                </button>
                <a href="/" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg font-semibold transition">
                    Reset
                </a>
            </div>
        </form>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            @php
                $items = $products ?? $motors ?? collect();
            @endphp

            @forelse($items as $item)
                <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden hover:scale-105 transition-transform">

                    @php
                        $images = [];
                        if ($item->images && $item->images->count() > 0) {
                            foreach ($item->images as $img) {
                                $images[] = asset('storage/' . $img->path);
                            }
                        }
                        if (empty($images)) {
                            $images[] = asset('images/no-image.png');
                        }
                    @endphp

                    <div class="relative h-48 bg-gray-700 overflow-hidden group">
                        <img class="slide-image-katalog absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                            src="{{ $images[0] }}"
                            data-images='@json($images)'
                            alt="{{ $item->nama ?? $item->name }}">
                    </div>

                    <div class="p-5 space-y-3">

                        <h3 class="text-xl font-bold">{{ $item->nama ?? $item->name }}</h3>

                        <p class="text-gray-400 text-sm">
                            {{ $item->merek ?? $item->brand }} - {{ $item->tahun ?? $item->year }}
                        </p>

                        <p class="text-red-500 text-lg font-bold">
                            Rp {{ number_format($item->harga ?? $item->price, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('katalog.show', $item) }}"
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Slideshow untuk katalog section
    const slideImages = document.querySelectorAll('.slide-image-katalog');
    
    slideImages.forEach(function(img) {
        const images = JSON.parse(img.dataset.images || '[]');
        
        if (images.length > 1) {
            let index = 0;
            
            setInterval(function() {
                index = (index + 1) % images.length;
                img.style.opacity = '0';
                
                setTimeout(function() {
                    img.src = images[index];
                    img.style.opacity = '1';
                }, 400);
            }, 3000);
        }
    });
    
    // Filter form handling (existing code)
    const filterForm = document.querySelector('.filter-form');
    
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Buat URL dengan query parameters
            const formData = new FormData(this);
            const params = new URLSearchParams(formData);
            const newUrl = '/?' + params.toString();
            
            // Smooth scroll ke katalog section
            const katalogSection = document.getElementById('katalog');
            if (katalogSection) {
                const offsetTop = katalogSection.getBoundingClientRect().top + window.scrollY;
                const navbarHeight = 70;
                const scrollPosition = offsetTop - navbarHeight;
                
                window.scrollTo({
                    top: scrollPosition,
                    behavior: 'smooth'
                });
            }
            
            // Update URL setelah 300ms (saat scroll animation berjalan)
            setTimeout(() => {
                window.history.pushState({}, '', newUrl);
                location.reload();
            }, 300);
        });
    }
});
</script>
