<nav class="bg-gray-900 p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold ml-3 text-white">IceSicle</h1>
    <div class="relative">
        <div id="profileButton" class="bg-gray-600 rounded-full w-8 h-8 cursor-pointer mr-3"></div>
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 text-gray-800 z-50">
            <p class="px-4 py-2 text-gray-700 border-b border-gray-300">Hi, {{ Auth::user()->name }}</p>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Keranjang</a>
            <a href="{{ route('product.pesanan') }}" class="block px-4 py-2 hover:bg-gray-100">Pesanan</a>
            <form action="{{ route('auth.logout') }}" method="POST" class="block px-4 py-2">
                @csrf
                <button type="submit" class="w-full text-left hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
</nav>


@push('scripts')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', () => {
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Check if the profileButton and dropdownMenu elements exist
    if (profileButton && dropdownMenu) {
        console.log('Profile button and dropdown menu found');

        // Toggle dropdown visibility
        profileButton.addEventListener('click', (event) => {
            console.log('Profile button clicked');
            dropdownMenu.classList.toggle('hidden');
            event.stopPropagation(); // Prevent event from bubbling up
        });

        // Hide dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('#profileButton') && !event.target.closest('#dropdownMenu')) {
                console.log('Clicked outside dropdown');
                dropdownMenu.classList.add('hidden');
            }
        });

        // Prevent dropdown menu itself from closing when clicked inside
        dropdownMenu.addEventListener('click', (event) => {
            console.log('Clicked inside dropdown');
            event.stopPropagation(); // Prevent event from bubbling up
        });
    } else {
        console.log('Profile button or dropdown menu not found');
    }
});
</script>
@endpush
