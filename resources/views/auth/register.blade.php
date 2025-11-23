@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-neutral-950 flex">

    {{-- Pastikan file gambar 'hero-bg.jpg' ada di folder public/images --}}
    <div class="hidden md:flex w-1/2 bg-cover bg-center"
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="bg-black/60 w-full h-full flex items-center justify-center">
            <h1 class="text-4xl font-bold text-red-600 drop-shadow-2xl tracking-wider">
                Daftar Akun Baru
            </h1>
        </div>
    </div>

    <div class="flex items-center justify-center w-full md:w-1/2 px-6 py-10 overflow-y-auto">

        <div class="bg-neutral-900 border border-red-600/40 rounded-2xl w-full max-w-md p-8
                    shadow-[0_0_35px_rgba(255,0,0,0.45)] backdrop-blur-xl relative mt-10 md:mt-0">

            <h2 class="text-3xl font-bold text-red-500 text-center mb-6 tracking-wide">
                Buat Akun
            </h2>

            {{-- Pesan Error Global --}}
            @if($errors->any())
                <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.process') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 transition"
                           placeholder="Nama Anda" required>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 transition"
                           placeholder="contoh@email.com" required>
                </div>

                 <div>
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Nomor WhatsApp (Aktif)</label>
                    <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 transition"
                           placeholder="Contoh: 081234567890" required>
                </div>

                 <div>
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                              class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                     focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 transition resize-none"
                              placeholder="Nama jalan, RT/RW, Kelurahan, Kecamatan..." required>{{ old('alamat') }}</textarea>
                </div>

                <div class="relative">
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Password</label>
                    <input type="password" name="password" id="inputPwd"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 pr-12 transition"
                           placeholder="Minimal 8 karakter" required>
                    
                    <button type="button" onclick="togglePassword('inputPwd', 'iconPwd')"
                            class="absolute right-3 top-[34px] text-gray-400 hover:text-red-500 transition">
                        <svg id="iconPwd" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.192-3.568M6.75 6.75A9.977 9.977 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.363 5.568M15 12a3 3 0 00-6 0" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <div class="relative">
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="inputConfirm"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 pr-12 transition"
                           placeholder="Ulangi password di atas" required>
                    
                    <button type="button" onclick="togglePassword('inputConfirm', 'iconConfirm')"
                            class="absolute right-3 top-[34px] text-gray-400 hover:text-red-500 transition">
                         <svg id="iconConfirm" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.192-3.568M6.75 6.75A9.977 9.977 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.363 5.568M15 12a3 3 0 00-6 0" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 rounded-lg font-bold text-gray-100 tracking-wider
                           transition shadow-[0_0_15px_rgba(255,0,0,0.5)]
                           hover:shadow-[0_0_25px_rgba(255,0,0,0.75)] transform hover:scale-[1.02]">
                    Daftar Sekarang
                </button>

                <p class="text-center text-gray-400 mt-3 text-sm">
                    Sudah punya akun?
                    {{-- Link ini akan membuka modal login di homepage --}}
                    <a href="/#login" class="text-red-500 hover:text-red-400 font-medium hover:underline transition">
                        Login disini
                    </a>
                </p>

            </form>
        </div>
    </div>
</div>

{{-- Javascript untuk Toggle Password (Bisa dipakai berulang) --}}
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        // Ubah jadi Ikon Mata Terbuka
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        `;
    } else {
        input.type = "password";
        // Ubah jadi Ikon Mata Tertutup (Dicoret)
        icon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.192-3.568M6.75 6.75A9.977 9.977 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.363 5.568M15 12a3 3 0 00-6 0" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
        `;
    }
}
</script>
@endsection