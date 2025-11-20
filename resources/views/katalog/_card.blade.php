@php
    // Support both Product-style ($product) and Motor-style ($motor) data structures.
    $item = $item ?? $product ?? $motor ?? null;

    // Normalize fields
    $images = [];
    if (is_object($item)) {
        if (method_exists($item, 'imageUrls')) {
            $images = $item->imageUrls();
        } elseif (!empty($item->image_url ?? null)) {
            $images = [ $item->image_url ];
        }
    }
    if (empty($images)) {
        $images = [ 'https://picsum.photos/seed/item' . ($item->id ?? rand(1000,9999)) . '/800/600' ];
    }

    $name = $item->nama_motor ?? $item->name ?? ($item->title ?? 'Motor');
    $brand = $item->merek ?? $item->brand ?? ($item->brand_name ?? '');
    $year = $item->tahun ?? $item->year ?? '';
    $price = $item->harga ?? $item->price ?? 0;
    $typeLabel = $item->tipe ?? $item->type ?? ($item->category ?? 'Motor');
    $detailRoute = route('katalog.show', $item);
@endphp

<div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">

    <div class="relative h-48 bg-gray-700 overflow-hidden">
        <img 
            src="{{ $images[0] }}"
            class="slide-image absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
            data-images='@json($images)'
            alt="{{ $name }}">

        <span class="absolute top-3 left-3 bg-red-600 text-white text-xs px-3 py-1 rounded-full">
            {{ ucfirst($typeLabel) ?? 'Motor' }}
        </span>
    </div>

    <div class="p-4 text-white">
        <h3 class="font-semibold text-lg">
            {{ $brand ? $brand . ' ' . $name : $name }}
        </h3>

        <p class="text-gray-400 text-sm">
            {{ $brand }} • {{ $year }}
        </p>

        <p class="mt-3 text-red-400 font-bold">
            Rp {{ number_format($price, 0, ',', '.') }}
        </p>

        <a href="{{ $detailRoute }}" class="block mt-4 w-full bg-red-600 text-center py-2 rounded-lg text-white font-semibold hover:bg-red-700">
            Lihat Detail
        </a>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const container = document.currentScript.previousElementSibling;
    if (!container) return;
    const img = container.querySelector(".slide-image");
    if (!img || !img.dataset.images) return;

    const images = JSON.parse(img.dataset.images || '[]');
    let index = 0;

    if (images.length > 1) {
        setInterval(() => {
            index = (index + 1) % images.length;
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = images[index];
                img.style.opacity = 1;
            }, 400);
        }, 3000);
    }
});
</script>
