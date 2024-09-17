<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - IceSicle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

    <!-- Registration Form -->
    <div class="bg-gray-800 p-4 rounded-lg shadow-lg w-full max-w-xs text-gray-200">
        <h2 class="text-xl font-bold mb-4 text-center text-white">Register for IceSicle</h2>
        <form action="{{ route('auth.register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-gray-400 mb-1" for="name">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white text-sm" placeholder="Enter your name" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="block text-gray-400 mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white text-sm" placeholder="Enter your email" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="block text-gray-400 mb-1" for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white text-sm" placeholder="Enter your phone number" required>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="block text-gray-400 mb-1" for="password">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white text-sm" placeholder="Enter your password" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-1" for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 bg-gray-700 border border-gray-600 rounded text-white text-sm" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="w-full bg-gray-700 text-white font-semibold py-2 rounded hover:bg-gray-600">Register</button>
        </form>
        @if(session('status'))
            <div class="bg-green-500 text-white p-3 rounded mt-4">
                {{ session('status') }}
            </div>
        @endif
        <p class="mt-4 text-gray-400 text-center text-sm">Already have an account? <a href="{{ route('auth.login') }}" class="text-blue-500">Login</a></p>
    </div>

</body>
</html>
