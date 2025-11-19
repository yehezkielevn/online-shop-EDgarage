<!-- 
    SECTION TENTANG KAMI (About Us)
    Location: Insert this section into resources/views/home.blade.php after the Katalog section
    Dependencies: None (uses Tailwind CSS only, no custom CSS or JS required)
    Optional variables: None required (all content hardcoded, can be easily replaced)
    
    Features:
    - Full Tailwind CSS (no inline styles)
    - Responsive layout (mobile/tablet/desktop)
    - Accessibility (heading hierarchy, alt text, aria-labels)
    - Smooth animations and transitions
    - Centered container with proper padding
-->

<section id="tentang" class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header / Title -->
        <div class="text-center lg:text-left mb-16">
            <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider">Tentang Kami</span>
            <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight">
                Kami Menyediakan Motor Bekas <br class="hidden lg:inline"> Berkualitas Terpercaya
            </h2>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl lg:max-w-none leading-relaxed">
                E&Dgarage adalah penyedia motor bekas berkualitas dengan integritas tinggi dan komitmen melayani pelanggan dengan terbaik.
            </p>
        </div>

        <!-- Main Content: Left Text + Right Image -->
        <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Left: Description + Value Points -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Mengapa Memilih E&Dgarage?</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dengan pengalaman lebih dari 5 tahun di industri otomotif, kami memahami kebutuhan Anda. 
                        Setiap motor yang kami jual telah melalui inspeksi menyeluruh untuk memastikan kualitas dan keamanan berkendara Anda.
                    </p>
                </div>

                <!-- Value Points / Bullet Items -->
                <div class="space-y-4">
                    <!-- Value Item 1 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100">
                                <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Surat Lengkap</h4>
                            <p class="mt-1 text-gray-600 text-sm">Semua dokumen resmi dan surat-surat kendaraan lengkap dan terjamin keasliannya.</p>
                        </div>
                    </div>

                    <!-- Value Item 2 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100">
                                <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Harga Bersaing</h4>
                            <p class="mt-1 text-gray-600 text-sm">Penawaran harga terbaik dengan kualitas premium tanpa mengorbankan standar kami.</p>
                        </div>
                    </div>

                    <!-- Value Item 3 -->
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-orange-100">
                                <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">Garansi Transaksi</h4>
                            <p class="mt-1 text-gray-600 text-sm">Jaminan kepuasan dan dukungan purna jual yang responsif untuk semua pelanggan kami.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="relative h-96 lg:h-full min-h-96 rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                @php
                    $aboutImage = file_exists(public_path('images/about-motor.jpg')) 
                        ? asset('images/about-motor.jpg') 
                        : 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                @endphp
                <img 
                    src="{{ $aboutImage }}" 
                    alt="Motor berkualitas dari E&Dgarage" 
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                >
            </div>
        </div>

        <!-- Team Section -->
        <div class="mt-20 border-t border-gray-200 pt-20">
            <div class="text-center mb-12">
                <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Tim Profesional Kami</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">Dipimpin oleh profesional berpengalaman yang berdedikasi melayani Anda dengan sepenuh hati.</p>
            </div>

            <!-- Team Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center hover:-translate-y-1">
                    <div class="flex justify-center mb-4">
                        <img 
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80" 
                            alt="Raka Setiawan - Founder" 
                            class="w-24 h-24 rounded-full object-cover border-4 border-orange-100"
                        >
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Raka Setiawan</h4>
                    <p class="text-sm text-orange-600 font-medium mt-1">Founder & CEO</p>
                    <p class="text-xs text-gray-500 mt-3">Visioner industri otomotif dengan pengalaman 8+ tahun</p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center hover:-translate-y-1">
                    <div class="flex justify-center mb-4">
                        <img 
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80" 
                            alt="Dina Kusuma - Service Manager" 
                            class="w-24 h-24 rounded-full object-cover border-4 border-orange-100"
                        >
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Dina Kusuma</h4>
                    <p class="text-sm text-orange-600 font-medium mt-1">Service Manager</p>
                    <p class="text-xs text-gray-500 mt-3">Ahli inspeksi kendaraan dan quality assurance bersertifikat</p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 p-6 text-center hover:-translate-y-1">
                    <div class="flex justify-center mb-4">
                        <img 
                            src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80" 
                            alt="Adi Wijaya - Sales Consultant" 
                            class="w-24 h-24 rounded-full object-cover border-4 border-orange-100"
                        >
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Adi Wijaya</h4>
                    <p class="text-sm text-orange-600 font-medium mt-1">Sales Consultant</p>
                    <p class="text-xs text-gray-500 mt-3">Profesional penjualan dengan kepuasan pelanggan 98%</p>
                </div>

            </div>
        </div>

        <!-- Contact Information -->
        <div class="mt-20 border-t border-gray-200 pt-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Contact Item: Phone -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Telepon</h4>
                        <a href="tel:+6281234567890" class="mt-1 text-gray-600 hover:text-orange-600 transition-colors" aria-label="Hubungi via telepon">
                            +62 812-3456-7890
                        </a>
                    </div>
                </div>

                <!-- Contact Item: Email -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Email</h4>
                        <a href="mailto:info@edgarage.com" class="mt-1 text-gray-600 hover:text-orange-600 transition-colors" aria-label="Kirim email ke E&Dgarage">
                            info@edgarage.com
                        </a>
                    </div>
                </div>

                <!-- Contact Item: Location -->
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-orange-100">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">Alamat</h4>
                        <p class="mt-1 text-gray-600">
                            Jl. Merdeka No. 42, Jakarta 12345, Indonesia
                        </p>
                        <a 
                            href="https://maps.google.com/?q=jakarta+edgarage" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="mt-2 inline-flex items-center text-orange-600 hover:text-orange-700 font-medium text-sm"
                            aria-label="Lihat lokasi E&Dgarage di Google Maps"
                        >
                            Lihat di Peta
                            <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- CTA Buttons Section -->
        <div class="mt-16 pt-16 border-t border-gray-200 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start items-center">
            <a 
                href="#katalog" 
                class="inline-flex items-center px-6 py-3 rounded-lg bg-orange-600 text-white font-semibold hover:bg-orange-700 hover:shadow-lg transition-all duration-200 transform hover:scale-105"
                aria-label="Lihat katalog motor kami"
            >
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Lihat Katalog
            </a>
            <a 
                href="mailto:info@edgarage.com?subject=Pertanyaan%20E%26Dgarage" 
                class="inline-flex items-center px-6 py-3 rounded-lg bg-gray-200 text-gray-900 font-semibold hover:bg-gray-300 transition-all duration-200"
                aria-label="Hubungi kami via email"
            >
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Hubungi Kami
            </a>
        </div>

    </div>
</section>
