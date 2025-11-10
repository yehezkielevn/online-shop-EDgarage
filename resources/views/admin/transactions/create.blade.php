@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Transaksi Baru</h1>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('admin.transactions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Pembeli *</label>
                <select name="user_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Pilih Pembeli</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Motor *</label>
                <select name="product_id" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="">Pilih Motor</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->harga }}">{{ $product->nama_motor }} - Rp {{ number_format($product->harga, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Metode Pembayaran *</label>
                <select name="metode_pembayaran" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Cashless">Cashless</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Status Pembayaran *</label>
                <select name="status_pembayaran" required class="w-full px-4 py-2 border rounded-lg">
                    <option value="pending">Pending</option>
                    <option value="success">Success</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Tanggal Transaksi *</label>
                <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', date('Y-m-d')) }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-medium mb-2">Total Harga (Rp) *</label>
                <input type="number" name="total_price" id="total_price" value="{{ old('total_price') }}" required class="w-full px-4 py-2 border rounded-lg">
            </div>
        </div>
        <div class="mt-6 flex gap-4">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.transactions.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.querySelector('select[name="product_id"]').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        if (price) {
            document.getElementById('total_price').value = price;
        }
    });
</script>
@endpush
@endsection


