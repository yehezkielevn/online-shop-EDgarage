<!-- 
    SECTION KONTAK (Contact Us)
    Location: Insert after the Tentang section in resources/views/home.blade.php
    Dependencies: None (uses Tailwind CSS only)
    Features:
    - Full Tailwind CSS design
    - Responsive layout (mobile/tablet/desktop)
    - WhatsApp integration
    - Google Maps integration
    - Accessibility features
-->

<section id="kontak" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                <span class="text-red-600">Hubungi Kami</span>
            </h2>
            <p class="mt-4 text-lg text-gray-600">Ada pertanyaan? Jangan ragu hubungi kami</p>
        </div>

        <!-- Main Content: Left Card + Right Map -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            
            <!-- Left: Contact Card -->
            <div>
                <!-- Contact Information Card -->
                <div class="bg-gray-900 rounded-2xl p-8 lg:p-10 shadow-xl">
                    
                    <!-- Card Title -->
                    <h3 class="text-2xl font-bold text-white mb-8">Informasi Kontak</h3>

                    <!-- Contact Items -->
                    <div class="space-y-6 mb-10">
                        
                        <!-- WhatsApp Item -->
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-600">
                                    <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.964 1.527v.008a9.868 9.868 0 0014.995 4.288l.008-.004a9.868 9.868 0 00-10.039-5.819zM12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">WhatsApp</h4>
                                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="text-gray-300 hover:text-red-400 transition-colors" aria-label="Chat via WhatsApp">
                                    +62 812-3456-7890
                                </a>
                            </div>
                        </div>

                        <!-- Email Item -->
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-600">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Email</h4>
                                <a href="mailto:info@edgarage.com" class="text-gray-300 hover:text-red-400 transition-colors" aria-label="Kirim email ke E&Dgarage">
                                    info@edgarage.com
                                </a>
                            </div>
                        </div>

                        <!-- Location Item -->
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-red-600">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold">Alamat</h4>
                                <p class="text-gray-300">Jl. Merdeka No. 42, Jakarta 12345, Indonesia</p>
                            </div>
                        </div>

                    </div>

                    <!-- WhatsApp Button -->
                    <a 
                        href="https://wa.me/6281234567890?text=Halo%20E%26Dgarage%2C%20saya%20ingin%20menanyakan%20tentang%20motor%20bekas%20anda." 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="w-full inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition-colors duration-200 mb-8"
                        aria-label="Chat via WhatsApp"
                    >
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.964 1.527v.008a9.868 9.868 0 0014.995 4.288l.008-.004a9.868 9.868 0 00-10.039-5.819zM12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0z"></path>
                        </svg>
                        Chat via WhatsApp
                    </a>

                    <!-- Operating Hours -->
                    <div class="border-t border-gray-700 pt-8">
                        <h4 class="text-xl font-bold text-white mb-4">Jam Operasional</h4>
                        <div class="space-y-2 text-gray-300">
                            <div class="flex justify-between">
                                <span>Senin – Jumat</span>
                                <span class="font-semibold">09:00 – 18:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Sabtu</span>
                                <span class="font-semibold">09:00 – 15:00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Minggu</span>
                                <span class="font-semibold text-red-400">Tutup</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right: Map -->
            <div class="relative h-96 lg:h-full min-h-96 rounded-2xl overflow-hidden shadow-xl">
                <a 
                    href="https://maps.google.com/?q=-6.2088,106.8456" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="block w-full h-full group relative"
                    aria-label="Buka lokasi E&Dgarage di Google Maps"
                >
                    <!-- Static Map Image -->
                    <img 
                        src="https://api.mapbox.com/styles/v1/mapbox/streets-v12/static/-6.2088,106.8456,12/600x600@2x?access_token=pk.eyJ1IjoiZXhhbXBsZSIsImEiOiJjazAwMDAwIn0.demo" 
                        alt="Lokasi E&Dgarage - Jl. Merdeka No. 42, Jakarta" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        loading="lazy"
                    >
                    <!-- Fallback: Static Google Maps Static API -->
                    <!-- If mapbox fails, you can use this alternative: -->
                    <!-- <img 
                        src="https://maps.googleapis.com/maps/api/staticmap?center=-6.2088,106.8456&zoom=15&size=600x600&key=YOUR_GOOGLE_MAPS_API_KEY" 
                        alt="Lokasi E&Dgarage" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                    > -->
                    
                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                        <div class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center">
                            <svg class="h-12 w-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            <p class="font-semibold">Lihat di Google Maps</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

    </div>
</section>
