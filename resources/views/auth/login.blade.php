<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - IceSicle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">

    <!-- Login Form -->
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-sm text-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">Login to IceSicle</h2>
        <form action="{{ route('auth.login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-400 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 bg-gray-700 border border-gray-600 rounded text-white" placeholder="Enter your email" required>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2" for="password">Password</label>
                <input type="password" id="password" name="password" class="w-full p-3 bg-gray-700 border border-gray-600 rounded text-white" placeholder="Enter your password" required>
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full mt-4 bg-gray-700 text-white font-semibold py-3 rounded hover:bg-gray-600">Login</button>
        </form>
        @if(session('status'))
            <div class="bg-green-500 text-white p-4 rounded mt-4">
                {{ session('status') }}
            </div>
        @endif
        <p class="mt-4 text-gray-400 text-center">Don't have an account? <a href="{{ route('auth.register') }}" class="text-blue-500">Register</a></p>
    </div>

</body>
</html>
