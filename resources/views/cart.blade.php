@extends('layout.main')

@section('title', 'Cart')

@section('content')
<div class="container mx-auto mt-5 p-6">
    <h2 class="text-3xl font-bold mb-6 text-center text-white">Keranjang Belanja</h2>

    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Foto Produk</th>
                    <th class="py-3 px-4">Produk</th>
                    <th class="py-3 px-4">Kuantitas</th>
                    <th class="py-3 px-4">Harga</th>
                    <th class="py-3 px-4">Total</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartItems as $index => $item)
                    <tr class="border-b border-gray-600">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                        <td class="py-3 px-4">
                        <img src="{{ asset('storage/' . $item->foto_produk) }}" alt="{{ $item->nama_produk }}" class="w-20 h-20 object-cover rounded-lg">
                        </td>
                        <td class="py-3 px-4">{{ $item->nama_produk }}</td>
                        <td class="py-3 px-4">{{ $item->kuantitas }}</td>
                        <td class="py-3 px-4">Rp. {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">Rp. {{ number_format($item->kuantitas * $item->harga_produk, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 px-3 py-1 rounded text-white hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-3 px-4 text-center">Your cart is empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        @if ($cartItems->count())
            <div class="mt-6 text-right">
                <p class="text-xl font-bold text-white">Total: Rp. {{ number_format($totalPrice, 0, ',', '.') }}</p>
            </div>

   
            <div class="flex justify-end mt-6">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-700 px-6 py-3 text-white font-semibold rounded hover:bg-gray-600">Checkout</button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
