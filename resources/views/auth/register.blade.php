@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Daftar Akun</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.perform') }}" class="space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
            <input 
                id="name"
                name="name" 
                type="text" 
                value="{{ old('name') }}" 
                required
                autofocus
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Masukkan nama lengkap"
            >
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input 
                id="email"
                name="email" 
                type="email" 
                value="{{ old('email') }}" 
                required
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Masukkan email"
            >
        </div>

        <!-- Nomor HP -->
        <div>
            <label for="nomor_hp" class="block text-gray-700 font-medium mb-2">Nomor HP</label>
            <input 
                id="nomor_hp"
                name="nomor_hp" 
                type="text" 
                value="{{ old('nomor_hp') }}"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                       focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="08xxxxxxxxxx"
            >
        </div>

        <!-- Admin Checkbox -->
        <div class="flex items-center">
            <input 
                id="is_admin" 
                name="is_admin" 
                type="checkbox" 
                value="1" 
                {{ old('is_admin') ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            >
            <label for="is_admin" class="ml-2 block text-sm text-gray-700">
                Daftar sebagai Admin (demo)
            </label>
        </div>

        <!-- Password Fields Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input 
                    id="password"
                    name="password" 
                    type="password" 
                    required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                           focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Buat password"
                >
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password</label>
                <input 
                    id="password_confirmation"
                    name="password_confirmation" 
                    type="password" 
                    required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900
                           focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Ulangi password"
                >
            </div>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full mt-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition duration-200"
        >
            Daftar Sekarang
        </button>

        <!-- Login Link -->
        <p class="text-center text-gray-600 mt-4 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">
                Masuk di sini
            </a>
        </p>
    </form>
</div>
@endsection
