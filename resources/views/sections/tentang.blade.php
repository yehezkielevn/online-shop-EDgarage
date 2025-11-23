<section id="tentang" class="py-24 lg:py-32 bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        <div class="relative rounded-3xl overflow-hidden shadow-lg">
            @php
                $aboutImage = file_exists(public_path('images/about-motor.jpg')) 
                    ? asset('images/about-motor.jpg') 
                    : 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=1000&q=80';
            @endphp

            <img 
                src="{{ $aboutImage }}" 
                alt="Tentang E&Dgarage" 
                class="w-full h-[520px] object-cover"
            >
        </div>

        <div class="space-y-8">
            <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                Tentang <span class="text-orange-600">E&Dgarage</span>
            </h2>

            <p class="text-lg text-gray-300 leading-relaxed">
                Kami adalah showroom motor bekas berkualitas yang selalu mengutamakan kepercayaan, keamanan, 
                dan kenyamanan pelanggan. Semua unit yang kami jual telah melalui proses inspeksi menyeluruh 
                sehingga siap pakai tanpa keraguan.
            </p>

            <p class="text-lg text-gray-300 leading-relaxed">
                Dengan layanan profesional dan pengalaman lebih dari 5 tahun, E&Dgarage berkomitmen memberikan 
                motor terbaik dengan harga yang tetap terjangkau tanpa mengurangi kualitas.
            </p>

            <a href="#katalog"
                class="inline-block px-8 py-3 mt-4 bg-orange-600 text-white font-semibold rounded-xl 
                       shadow-md hover:bg-orange-700 hover:shadow-lg transition-all duration-200">
                Lihat Katalog
            </a>
        </div>

    </div>
</section>
