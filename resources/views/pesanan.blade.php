@extends('layout.main')

@section('title', 'Pesanan')

@section('content')
<div class="pt-20 max-w-4xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-4">Pesanan</h2>
    <p class="text-lg mb-6">
        <a href="{{ route('pesanan.index', ['status' => 'Packaging']) }}" class="text-gray-200 mr-4">Packaging</a>
        <a href="{{ route('pesanan.index', ['status' => 'On The Way']) }}" class="text-yellow-400 mr-4">On The Way</a>
        <a href="{{ route('pesanan.index', ['status' => 'Delivered']) }}" class="text-green-500 mr-4">Delivered</a>
        <a href="{{ route('pesanan.index', ['status' => 'Canceled']) }}" class="text-red-500 mr-4">Canceled</a>
    </p>

    @foreach($pesanan as $order)
    <div class="flex items-center justify-between bg-gray-600 p-4 rounded-lg shadow-md mb-4">
        <div class="flex items-center">
            <img src="{{ asset('storage/' . $order->foto_produk) }}" alt="{{ $order->nama_produk }}" class="w-24 h-24 mr-4">
            <div>
                <h3 class="text-2xl font-semibold text-gray-200">{{ $order->nama_produk }}</h3>
                <p class="text-gray-400">Qty: {{ $order->kuantitas }}</p>
                <p class="text-gray-400">Rp. {{ number_format($order->harga_produk * $order->kuantitas, 0, ',', '.') }}</p>
            </div>
        </div>
        <span class="
            text-lg font-semibold 
            @if($order->status === 'Delivered') text-green-500 
            @elseif($order->status === 'On The Way') text-yellow-400 
            @elseif($order->status === 'Canceled') text-red-500 
            @else text-gray-300 
            @endif
        ">
            {{ $order->status }}
        </span>
    </div>
@endforeach
</div>
@endsection
