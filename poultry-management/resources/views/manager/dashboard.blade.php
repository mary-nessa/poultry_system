<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
</head>
<body class="bg-gray-100 text-center">
    <h1 class="text-3xl font-bold text-green-600 mt-10">Welcome, Manager! 🚀</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-red-500 hover:underline">Logout</button>
    </form>
    
</body>
</html>
