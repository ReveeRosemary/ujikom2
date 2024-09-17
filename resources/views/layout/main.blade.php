<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>    
</head>

<body class="bg-gray-800 text-white">
    @include('layout.navbar')

    <!-- Main Content -->
    <div class="container mx-auto py-8">
        @yield('content')
    </div>
    
    <!-- Include main app.js file -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Stack pushed scripts here -->
    @stack('scripts')
</body>

</html>
