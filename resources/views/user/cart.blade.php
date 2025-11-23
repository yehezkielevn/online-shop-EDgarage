@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white pt-32 pb-10 px-6">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-3xl font-bold mb-8 border-b border-gray-700 pb-4">Keranjang Belanja</h2>

        @if($carts->isEmpty())
            <div class="text-center py-20 bg-gray-900 rounded-xl border border-gray-800">
                <p class="text-gray-400 mb-4">Keranjang kamu kosong.</p>
                <a href="/" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Cari Motor</a>
            </div>
        @else
            <form action="{{ route('checkout.page') }}" method="GET" id="checkoutForm">
                
                <div class="bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-800">
                    @foreach($carts as $item)
                        <div class="flex items-center justify-between border-b border-gray-700 py-6 last:border-0 gap-4">
                            
                            <div class="flex items-center gap-4">
                                <input type="checkbox" name="selected_products[]" value="{{ $item->id }}" 
                                       class="product-checkbox w-5 h-5 text-red-600 bg-gray-700 border-gray-600 rounded focus:ring-red-500"
                                       data-price="{{ $item->product->harga }}"
                                       onclick="calculateTotal()">
                                
                                <div class="h-20 w-28 bg-gray-700 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product->gambar && count($item->product->gambar) > 0)
                                        <img src="{{ asset('storage/'.$item->product->gambar[0]) }}" class="h-full w-full object-cover">
                                    @endif
                                </div>

                                <div>
                                    <h4 class="text-lg font-bold text-white">{{ $item->product->nama_motor }}</h4>
                                    <p class="text-sm text-gray-400">{{ $item->product->tahun }} | {{ $item->product->merek }}</p>
                                    <p class="text-red-500 font-bold mt-1">Rp {{ number_format($item->product->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            <a href="{{ route('cart.delete', $item->id) }}" class="text-gray-500 hover:text-red-500 p-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="fixed bottom-0 left-0 w-full bg-gray-900 border-t border-gray-800 p-4 z-40 shadow-2xl">
                    <div class="max-w-5xl mx-auto flex justify-between items-center">
                        <div>
                            <p class="text-gray-400 text-sm">Total Harga:</p>
                            <p class="text-2xl font-bold text-red-500" id="totalDisplay">Rp 0</p>
                        </div>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-10 rounded-full shadow-lg transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed" id="btnCheckout" disabled>
                            Checkout (<span id="countDisplay">0</span>)
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
    function calculateTotal() {
        let total = 0;
        let count = 0;
        const checkboxes = document.querySelectorAll('.product-checkbox:checked');
        const btnCheckout = document.getElementById('btnCheckout');

        checkboxes.forEach(box => {
            total += parseInt(box.getAttribute('data-price'));
            count++;
        });

        // Format Rupiah
        document.getElementById('totalDisplay').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        document.getElementById('countDisplay').innerText = count;

        // Enable/Disable Button
        if (count > 0) {
            btnCheckout.removeAttribute('disabled');
        } else {
            btnCheckout.setAttribute('disabled', 'true');
        }
    }
</script>
@endsection