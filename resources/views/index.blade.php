@extends('layout.main')

@section('title', 'IceSicle - Products')

@section('content')

    <h2 class="text-4xl font-bold text-center mb-6">Bestseller</h2>
    <div class="carousel relative overflow-hidden" id="bestsellerCarousel">
        <div class="flex transition-transform duration-500 ease-in-out">
            @foreach ($bestsellerProducts as $product)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/5 flex-shrink-0 p-4 flex items-center justify-center">
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
        
        <button id="prevButton" class="carousel-control prevButton absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextButton" class="carousel-control nextButton absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <h2 class="text-4xl font-bold text-center mb-6">New Arrivals</h2>
    <div class="carousel relative overflow-hidden" id="newArrivalsCarousel">
        <div class="flex transition-transform duration-500 ease-in-out">
            @foreach ($newArrivals as $product)
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/5 flex-shrink-0 p-4 flex items-center justify-center">
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
        
        <button id="prevButton" class="carousel-control prevButton absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button id="nextButton" class="carousel-control nextButton absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-900 bg-opacity-50 p-2 rounded-full hover:bg-opacity-75">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('.carousel');
    
    function getVisibleItems() {
        if (window.innerWidth < 640) {
            return 1;
        } else if (window.innerWidth >= 640 && window.innerWidth < 768) {
            return 2;
        } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
            return 3;
        } else {
            return 5;
        }
    }

    function getItemWidth(carousel) {
        return carousel.querySelector('.flex > div').offsetWidth;
    }

    function updateCarousel(carousel, currentIndex, itemWidth) {
        carousel.querySelector('.flex').style.transform = `translateX(-${currentIndex * itemWidth}px)`;
    }

    carousels.forEach(carousel => {
        let currentIndex = 0;
        let visibleItems = getVisibleItems();
        let itemWidth = getItemWidth(carousel);
        const totalItems = carousel.querySelector('.flex').children.length;

        function showNextSlide() {
            if (currentIndex >= totalItems - visibleItems) {
                currentIndex = 0;
            } else {
                currentIndex++;
            }
            updateCarousel(carousel, currentIndex, itemWidth);
        }

        function showPrevSlide() {
            if (currentIndex === 0) {
                currentIndex = totalItems - visibleItems;
            } else {
                currentIndex--;
            }
            updateCarousel(carousel, currentIndex, itemWidth);
        }

        carousel.querySelector('.prevButton').addEventListener('click', showPrevSlide);
        carousel.querySelector('.nextButton').addEventListener('click', showNextSlide);

        setInterval(() => {
            visibleItems = getVisibleItems();
            itemWidth = getItemWidth(carousel);
            updateCarousel(carousel, currentIndex, itemWidth);
            showNextSlide();
        }, 3000);

        window.addEventListener('resize', () => {
            visibleItems = getVisibleItems();
            itemWidth = getItemWidth(carousel);
            updateCarousel(carousel, currentIndex, itemWidth);
        });
    });
});
</script>
@endpush
