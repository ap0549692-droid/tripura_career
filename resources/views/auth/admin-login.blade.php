<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - Tripura Career</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-2">Admin Login</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Tripura Career</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <input type="email" name="email" value="admin@tripura.com" required class="w-full p-3 border rounded mb-4" placeholder="admin@tripura.com">
            <input type="password" name="password" required class="w-full p-3 border rounded mb-4" placeholder="password123">
            <button class="w-full bg-black text-white p-3 rounded font-bold">Login as Admin</button>
        </form>
    </div>
</body>
</html>