@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-24 pb-10 px-4 md:px-8">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-red-500 transition group font-medium">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <div class="bg-neutral-900 rounded-2xl p-6 border border-neutral-800 flex flex-col md:flex-row items-center md:items-start gap-6 shadow-2xl relative overflow-hidden mb-8">
            
            <div class="relative group">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-neutral-800 shadow-lg">
                    @if($user->foto_profil)
                        <img src="{{ asset('storage/' . $user->foto_profil) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-neutral-700 flex items-center justify-center text-4xl font-bold text-neutral-500">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <button onclick="document.getElementById('fotoInput').click()" class="absolute bottom-1 right-1 bg-red-600 p-2 rounded-full hover:bg-red-700 transition shadow-lg" title="Ganti Foto">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </button>
            </div>

            <div class="flex-1 text-center md:text-left">
                <h1 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h1>
                <p class="text-gray-400 text-sm mb-4">{{ $user->email }}</p>
                
                <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                    <button onclick="openEditModal()" class="px-4 py-2 text-sm font-medium text-white bg-neutral-800 hover:bg-neutral-700 rounded-lg border border-neutral-700 transition">
                        Edit Profil
                    </button>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-red-500 hover:text-red-400 hover:bg-red-900/20 rounded-lg border border-transparent transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex border-b border-neutral-800 mb-8 overflow-x-auto">
            <button class="tab-btn px-8 py-3 text-sm font-medium text-white border-b-2 border-red-600 focus:outline-none transition" onclick="showTab('profil', this)">Profil</button>
            <button class="tab-btn px-8 py-3 text-sm font-medium text-gray-400 hover:text-white focus:outline-none transition" onclick="showTab('riwayat', this)">Riwayat Pembelian</button>
            <button class="tab-btn px-8 py-3 text-sm font-medium text-gray-400 hover:text-white focus:outline-none transition" onclick="showTab('pengaturan', this)">Pengaturan</button>
        </div>

        @if(session('success'))
            <div class="bg-green-900/50 border border-green-600 text-green-200 px-4 py-3 rounded-lg mb-6 text-sm text-center shadow-lg shadow-green-900/20">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-900/50 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-6 text-sm text-center shadow-lg shadow-red-900/20">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="tab-profil" class="tab-content block animate-fadeIn">
            <div class="bg-neutral-900 rounded-2xl p-8 border border-neutral-800 shadow-lg">
                <h3 class="text-lg font-bold text-white mb-1">Informasi Pribadi</h3>
                <p class="text-sm text-gray-400 mb-6">Kelola data pribadi Anda</p>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Nama Lengkap</label>
                        <p class="text-white text-lg font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Email</label>
                        <p class="text-white text-lg font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Nomor WhatsApp</label>
                        <p class="text-white text-lg font-medium">{{ $user->nomor_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Alamat Lengkap</label>
                        <p class="text-white text-lg font-medium">{{ $user->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab-riwayat" class="tab-content hidden animate-fadeIn">
            <div class="bg-neutral-900 rounded-2xl p-8 border border-neutral-800 shadow-lg min-h-[300px]">
                <h3 class="text-lg font-bold text-white mb-1">Riwayat Pembelian</h3>
                <p class="text-sm text-gray-400 mb-6">Daftar motor yang pernah Anda beli</p>

                @if($transactions->count() > 0)
                    <div class="space-y-4">
                        @foreach($transactions as $trx)
                            <div class="flex items-center justify-between p-4 bg-neutral-800/50 rounded-xl border border-neutral-800 hover:border-neutral-600 transition">
                                <div>
                                    <h4 class="text-white font-bold">{{ $trx->product->nama_motor ?? 'Produk Dihapus' }}</h4>
                                    <p class="text-xs text-gray-400">{{ $trx->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-red-500 font-bold mb-1">Rp {{ number_format($trx->amount) }}</p>
                                    <span class="text-xs px-2 py-1 rounded 
                                        {{ $trx->status_pembayaran == 'success' ? 'bg-green-900/30 text-green-400 border border-green-800' : 
                                          ($trx->status_pembayaran == 'pending' ? 'bg-yellow-900/30 text-yellow-400 border border-yellow-800' : 'bg-red-900/30 text-red-400 border border-red-800') }}">
                                        {{ ucfirst($trx->status_pembayaran) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-500">
                        <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        <p>Belum ada riwayat pembelian</p>
                    </div>
                @endif
            </div>
        </div>

        <div id="tab-pengaturan" class="tab-content hidden animate-fadeIn">
            <div class="bg-neutral-900 rounded-2xl p-8 border border-neutral-800 shadow-lg">
                
                <div class="mb-10">
                    <h3 class="text-lg font-bold text-white mb-6 pb-2 border-b border-neutral-800">Ganti Password</h3>
                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-5 max-w-md">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Password Lama</label>
                            <input type="password" name="current_password" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white focus:border-red-600 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Password Baru</label>
                            <input type="password" name="new_password" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white focus:border-red-600 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2.5 text-white focus:border-red-600 outline-none transition">
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium transition shadow-lg">Simpan Password</button>
                    </form>
                </div>

                <div class="pt-6 border-t border-neutral-800">
                    <h3 class="text-lg font-bold text-red-500 mb-2">Zona Berbahaya</h3>
                    <p class="text-sm text-gray-400 mb-6">Menghapus akun akan menghilangkan semua data riwayat pembelian Anda secara permanen.</p>
                    
                    <form action="{{ route('profile.delete') }}" method="POST" onsubmit="return confirm('APAKAH ANDA YAKIN? \nAkun Anda akan dihapus permanen dan tidak bisa dikembalikan.');">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="flex items-center gap-2 px-6 py-2.5 border border-red-600/50 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Akun Saya
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
    <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditModal()"></div>
    <div class="bg-neutral-900 border border-neutral-700 rounded-2xl w-full max-w-lg p-6 relative z-10 shadow-2xl transform transition-all scale-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Edit Profil</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">&times;</button>
        </div>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            
            <input type="file" name="foto_profil" id="fotoInput" class="hidden" onchange="this.form.submit()">

            <div>
                <label class="block text-sm text-gray-400 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white focus:border-red-600 outline-none">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white focus:border-red-600 outline-none">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Nomor WhatsApp</label>
                <input type="text" name="nomor_hp" value="{{ $user->nomor_hp }}" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white focus:border-red-600 outline-none">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full bg-neutral-800 border border-neutral-700 rounded-lg px-4 py-2 text-white focus:border-red-600 outline-none">{{ $user->alamat }}</textarea>
            </div>

            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-neutral-800">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-400 hover:text-white transition">Batal</button>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium shadow-lg transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showTab(tabName, btnElement) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        // Show selected tab
        document.getElementById('tab-' + tabName).classList.remove('hidden');

        // Reset nav buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-b-2', 'border-red-600', 'text-white');
            btn.classList.add('text-gray-400');
        });
        // Highlight active button
        btnElement.classList.remove('text-gray-400');
        btnElement.classList.add('border-b-2', 'border-red-600', 'text-white');
    }

    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
<style>
    .animate-fadeIn { animation: fadeIn 0.3s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection