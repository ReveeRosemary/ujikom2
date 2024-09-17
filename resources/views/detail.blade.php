@extends('layout.main') {{-- Ensure this extends your main layout --}}

@section('title', 'Product Detail') {{-- Set the page title --}}

@section('content')
<div class="bg-gray-300 p-8 rounded-lg shadow-md flex items-center relative mx-auto max-w-lg mt-12 mb-8">
    <!-- Close Button -->
    <button onclick="window.location.href='{{ route('product.index') }}'" class="absolute top-2 right-2 text-gray-800 font-bold">X</button>
    
    <!-- Product Image -->
    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="w-40 h-40 object-cover rounded-lg">
    
    <!-- Product Details -->
    <div class="ml-6">
        <h2 class="text-xl font-bold text-gray-800">{{ $product->nama_produk }}</h2>
        <p class="text-gray-700">{{ $product->toko->nama_toko }}</p>
        <p class="text-gray-700">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
        <p class="text-gray-700" id="stockDisplay">Stok: {{ $product->stok }}</p>

        <!-- Quantity Controls -->
        <div class="flex items-center mt-2">
            <span class="text-gray-700">Kuantitas</span>
            <div class="flex items-center border border-gray-400 rounded ml-2">
                <button id="decrementButton" class="px-3 py-2 text-gray-800" onclick="adjustQuantity(-1)">-</button>
                <input id="quantityInput" type="text" value="1" class="w-12 text-center border-none outline-none text-gray-800">
                <button id="incrementButton" class="px-3 py-2 text-gray-800" onclick="adjustQuantity(1)">+</button>
            </div>
        </div>

        <!-- Add to Cart Form -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="quantity" id="hiddenQuantityInput" value="1">
            <button type="submit" class="px-6 py-3 bg-red-600 text-white font-semibold rounded">BELI</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    function adjustQuantity(change) {
        const quantityInput = document.getElementById('quantityInput');
        const hiddenQuantityInput = document.getElementById('hiddenQuantityInput');
        let currentQuantity = parseInt(quantityInput.value);
        const stock = parseInt(document.getElementById('stockDisplay').textContent.replace('Stok: ', ''));
        
        if (currentQuantity + change >= 1 && currentQuantity + change <= stock) {
            quantityInput.value = currentQuantity + change;
            hiddenQuantityInput.value = currentQuantity + change;
        }
    }
</script>
@endpush

