@extends('layout.main')

@section('title', 'IceSicle - Products')

@section('content')
    <!-- Bestseller Carousel -->
    <h2 class="text-4xl font-bold text-center mb-6">Bestseller</h2>
    <div class="carousel relative overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out">
            <!-- Product items -->
            @foreach ($bestsellerProducts as $product)
            <div class="w-full sm:w-1/2 lg:w-1/5 flex-shrink-0 p-4 flex items-center justify-center">
            <a href="{{ route('product.details', ['id' => $product->id]) }}" class="w-full h-full flex items-center justify-center">
                    <div class="bg-gray-700 rounded-lg p-4 text-center w-full h-full flex flex-col items-center justify-between">
                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="mb-4 rounded-md w-24 h-24 object-cover">
                        <h3 class="text-xl font-semibold mb-2">{{ $product->nama_produk }}</h3>
                        <p class="text-lg">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Controls -->
        <button id="prevButton" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextButton" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- New Arrivals Carousel -->
    <h2 class="text-4xl font-bold text-center mb-6">New Arrivals</h2>
    <div class="carousel relative overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out">
            <!-- Product items -->
            @foreach ($newArrivals as $product)
            <div class="w-full sm:w-1/2 lg:w-1/5 flex-shrink-0 p-4 flex items-center justify-center">
                <a href="{{ url('/detil_produk/' . $product->id) }}" class="w-full h-full flex items-center justify-center">
                    <div class="bg-gray-700 rounded-lg p-4 text-center w-full h-full flex flex-col items-center justify-between">
                    <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama_produk }}" class="mb-4 rounded-md w-24 h-24 object-cover">
                        <h3 class="text-xl font-semibold mb-2">{{ $product->nama_produk }}</h3>
                        <p class="text-lg">Rp. {{ number_format($product->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- Controls -->
        <button id="prevButton" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextButton" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('#carousel');
    const totalItems = carousels[0].children[0].children.length; // Same items for both carousels
     
    function getVisibleItems() {
        return window.innerWidth < 768 ? 1 : 5; // 1 item for mobile, 5 for desktop
    }

    function getItemWidth(carousel) {
        return carousel.children[0].children[0].offsetWidth;
    }

    function updateCarousel(carousel, currentIndex, itemWidth) {
        carousel.children[0].style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    }

    carousels.forEach(carousel => {
        let currentIndex = 0;
        let visibleItems = getVisibleItems();
        let itemWidth = getItemWidth(carousel);

        function showNextSlide() {
            if (currentIndex >= totalItems - visibleItems) {
                currentIndex = 0; // Loop back to the start
            } else {
                currentIndex++;
            }
            updateCarousel(carousel, currentIndex, itemWidth);
        }

        function showPrevSlide() {
            if (currentIndex === 0) {
                currentIndex = totalItems - visibleItems; // Loop to the end
            } else {
                currentIndex--;
            }
            updateCarousel(carousel, currentIndex, itemWidth);
        }

        carousel.querySelector('#prevButton').addEventListener('click', showPrevSlide);
        carousel.querySelector('#nextButton').addEventListener('click', showNextSlide);

        // Auto slide every 3 seconds
        setInterval(() => {
            visibleItems = getVisibleItems(); // Update visible items on resize
            itemWidth = getItemWidth(carousel); // Update item width on resize
            updateCarousel(carousel, currentIndex, itemWidth);
            showNextSlide();
        }, 3000);

        // Adjust carousel when window is resized
        window.addEventListener('resize', () => {
            visibleItems = getVisibleItems();
            itemWidth = getItemWidth(carousel); // Update item width on resize
            updateCarousel(carousel, currentIndex, itemWidth);
        });
    });
});
</script>
@endpush
