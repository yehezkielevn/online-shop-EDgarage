@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-neutral-950 flex">

    {{-- Menggunakan gambar yang sama dengan register agar konsisten --}}
    <div class="hidden md:flex w-1/2 bg-cover bg-center"
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="bg-black/60 w-full h-full flex items-center justify-center">
            <h1 class="text-4xl font-bold text-red-600 drop-shadow-2xl tracking-wider">
                Selamat Datang Kembali
            </h1>
        </div>
    </div>

    <div class="flex items-center justify-center w-full md:w-1/2 px-6 py-10">

        <div class="bg-neutral-900 border border-red-600/40 rounded-2xl w-full max-w-md p-8
                    shadow-[0_0_35px_rgba(255,0,0,0.45)] backdrop-blur-xl relative">

            <h2 class="text-3xl font-bold text-red-500 text-center mb-6 tracking-wide">
                Login Akun
            </h2>

            @if(session('success'))
                <div class="bg-green-900/50 border border-green-600 text-green-200 px-4 py-3 rounded-lg mb-6 text-sm text-center shadow-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 text-sm text-center shadow-lg">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 transition"
                           placeholder="email@anda.com" required autofocus>
                </div>

                <div class="relative">
                    <label class="block mb-1 font-medium text-gray-300 text-sm">Password</label>
                    <input type="password" name="password" id="loginPwd"
                           class="w-full px-4 py-3 bg-neutral-800 text-gray-200 border border-neutral-700 rounded-lg
                                  focus:ring-2 focus:ring-red-600 focus:outline-none shadow-inner shadow-black/40 pr-12 transition"
                           placeholder="••••••••" required>
                    
                    <button type="button" onclick="toggleLoginPwd()"
                            class="absolute right-3 top-[34px] text-gray-400 hover:text-red-500 transition">
                        <svg id="iconLoginPwd" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-red-600 hover:bg-red-700 rounded-lg font-bold text-gray-100 tracking-wider
                           transition shadow-[0_0_15px_rgba(255,0,0,0.5)]
                           hover:shadow-[0_0_25px_rgba(255,0,0,0.75)] transform hover:scale-[1.02]">
                    Masuk Sekarang
                </button>

            </form>

            <div class="mt-6 text-center text-sm text-gray-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-red-500 hover:text-red-400 font-medium hover:underline transition">
                    Daftar disini
                </a>
            </div>
            
            <div class="mt-4 text-center">
                <a href="/" class="text-xs text-gray-500 hover:text-white transition">← Kembali ke Beranda</a>
            </div>

        </div>
    </div>
</div>

<script>
function toggleLoginPwd() {
    const input = document.getElementById('loginPwd');
    const icon = document.getElementById('iconLoginPwd');
    
    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.192-3.568M6.75 6.75A9.977 9.977 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.056 10.056 0 01-4.363 5.568M15 12a3 3 0 00-6 0" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />`;
    } else {
        input.type = "password";
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    }
}
</script>
@endsection