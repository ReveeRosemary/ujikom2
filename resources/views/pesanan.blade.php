@extends('layout.main')

@section('title', 'Pesanan')

@section('content')
<div class="pt-20 max-w-4xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-4">Pesanan</h2>
    <p class="text-lg mb-6">
        <a href="{{ route('product.pesanan', ['status' => 'Packaging']) }}" class="text-gray-200 mr-4">Menunggu Konfirmasi</a>
        <a href="{{ route('product.pesanan', ['status' => 'On The Way']) }}" class="text-yellow-400 mr-4">Dalam Perjalanan</a>
        <a href="{{ route('product.pesanan', ['status' => 'Delivered']) }}" class="text-green-500 mr-4">Sudah Sampai</a>
        <a href="{{ route('product.pesanan', ['status' => 'Canceled']) }}" class="text-red-500 mr-4">Canceled</a>
    </p>

    @foreach($pesanan as $order)
        <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-md mb-4">
            <div class="flex items-center">
                <img src="{{ asset('storage/' . $order->foto_produk) }}" alt="{{ $order->nama_produk }}" class="w-24 h-24 mr-4">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900">{{ $order->nama_produk }}</h3>
                    <p class="text-gray-900">Qty: {{ $order->kuantitas }}</p>
                    <p class="text-gray-900">Rp. {{ number_format($order->harga_produk * $order->kuantitas, 0, ',', '.') }}</p>
                </div>
            </div>
            <span class="text-lg font-semibold {{ $order->status === 'Delivered' ? 'text-green-500' : '' }}">
                {{ $order->status }}
            </span>
        </div>
    @endforeach
</div>
@endsection
