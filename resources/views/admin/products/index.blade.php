@extends('layouts.admin')

@section('title', 'Kelola Produk - E&Dgarage')
@section('header-title', 'Daftar Motor')

@section('content')
    @if(session('success'))
        <div id="alert-box" class="bg-green-900/50 border border-green-600 text-green-300 px-4 py-3 rounded mb-6 flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button onclick="document.getElementById('alert-box').remove()" class="text-green-300 hover:text-white">&times;</button>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-white">Stok Unit</h3>
        <a href="{{ route('admin.products.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Motor
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Gambar</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Nama Motor</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Merek</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-400 uppercase">Harga</th>
                        <th class="px-6 py-3 text-center text-xs text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                @if($product->gambar && is_array($product->gambar) && count($product->gambar) > 0)
                                    <img class="h-12 w-12 rounded object-cover border border-gray-600" src="{{ asset('storage/' . $product->gambar[0]) }}">
                                @else
                                    <div class="h-12 w-12 rounded bg-gray-700 flex items-center justify-center text-xs text-gray-500">No Pic</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-white">{{ $product->nama_motor }}</td>
                            <td class="px-6 py-4 text-sm text-gray-300 capitalize">{{ $product->merek }}</td>
                            <td class="px-6 py-4 text-sm text-red-400 font-bold">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-400 hover:text-blue-300 bg-blue-900/20 p-2 rounded hover:bg-blue-900/50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <button onclick="openDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ $product->nama_motor }}')" 
                                        class="text-red-400 hover:text-red-300 bg-red-900/20 p-2 rounded hover:bg-red-900/50 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-700">{{ $products->links() }}</div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>
        <div class="relative bg-gray-800 rounded-xl shadow-2xl border border-gray-600 w-full max-w-md p-6 transform transition-all scale-100">
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-900/30 mb-4">
                <svg class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-bold text-white mb-2">Hapus Motor Ini?</h3>
                <p class="text-gray-400 text-sm">Anda akan menghapus <span id="modalProductName" class="text-white font-bold"></span>.</p>
            </div>
            <div class="mt-6 flex justify-center gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Ya, Hapus!</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(url, name) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('modalProductName').innerText = '"' + name + '"';
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection