@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Profil</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Edit Profil -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Informasi Profil</h2>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nomor HP</label>
                    <input type="text" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                    <textarea name="alamat" class="w-full px-4 py-2 border rounded-lg">{{ old('alamat', $user->alamat) }}</textarea>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Foto Profil</label>
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Foto Profil" class="w-20 h-20 rounded-full mb-2 object-cover">
                    @endif
                    <input type="file" name="foto_profil" accept="image/*" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Ubah Password -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Ubah Password</h2>
        <form action="{{ route('admin.profile.password') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password Saat Ini *</label>
                    <input type="password" name="current_password" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Password Baru *</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Konfirmasi Password Baru *</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg">
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">Ubah Password</button>
            </div>
        </form>
    </div>
</div>
@endsection


