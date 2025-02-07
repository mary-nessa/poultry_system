<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Poultry Management System</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row w-full md:w-4/5 lg:w-3/5 overflow-hidden">
        
        <!-- Left Side: Poultry Image -->
        <div class="w-full md:w-1/2 hidden md:block bg-cover bg-center" 
            style="background-image: url('{{ asset('images/poultry.jpg') }}'); min-height: 400px;">
        </div>

        <!-- Right Side: Login/Register Section -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center text-gray-800">Welcome to Poultry Management</h2>
            <p class="text-center text-gray-600 mt-2">Effortlessly manage your poultry farm operations.</p>

            <div class="mt-6 flex flex-col space-y-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md text-center shadow-md hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-600 text-white rounded-md text-center shadow-md hover:bg-gray-700 transition">
                    Register
                </a>
            </div>
        </div>

    </div>

</body>
</html>
