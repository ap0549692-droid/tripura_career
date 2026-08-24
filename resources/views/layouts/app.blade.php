<!DOCTYPE html>
<html>
<head>
    <title>Tripura Career - Jobs & Scholarships</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon Added -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpeg') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
   .main-bg {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 20% 20%, hsla(28,100%,74%,0.15) 0px, transparent 50%),
                radial-gradient(at 80% 20%, hsla(189,100%,56%,0.15) 0px, transparent 50%),
                radial-gradient(at 50% 80%, hsla(355,100%,93%,0.4) 0px, transparent 50%);
            min-height: 100vh;
        }
   .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }
   .nav-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="main-bg">

<nav class="nav-glass shadow-sm p-4 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="font-bold text-xl">🔥 <span class="text-orange-600">Tripura</span> Career</a>
        <ul class="flex gap-3 md:gap-6 font-semibold text-sm items-center">
            <li><a href="/" class="hover:text-orange-600 hidden md:block">Home</a></li>
            <li><a href="/jobs">Govt Jobs</a></li>
            <li><a href="/scholarships">Scholarships</a></li>
            <a href="/admit-cards" class="mr-4 hover:text-orange-500">Admit Cards</a>
            <li><a href="/dashboard" class="bg-black text-white px-5 py-2.5 rounded-full"><i class="fa-solid fa-gauge-high mr-1"></i> Dashboard</a></li>
        </ul>
    </div>
</nav>

<div class="max-w-7xl mx-auto mt-8 px-4 pb-10 min-h-[70vh]">
    @yield('content')
</div>

<footer class="mt-20 border-t glass-card">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-8 text-sm">
        <div>
            <h3 class="font-bold text-lg">🔥 Tripura Career</h3>
            <p class="text-gray-500 mt-2">Tripura's fastest & verified portal for Govt Jobs and Scholarships.</p>
            <div class="flex gap-3 mt-4">
                <a href="https://www.facebook.com/profile.php?id=61593295217124" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/tripura_career/" target="_blank" class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 text-white rounded-full flex items-center justify-center"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div>
            <h4 class="font-bold">Join Our Community</h4>
            <p class="mt-2 text-gray-600">Get daily updates on WhatsApp, Facebook & Instagram:</p>
            <a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="mt-3 inline-flex items-center gap-2 bg-green-500 text-white px-5 py-2.5 rounded-full font-bold hover:bg-green-600 transition"><i class="fa-brands fa-whatsapp text-lg"></i> Join WhatsApp Group</a>
        </div>
    </div>
    <div class="text-center py-4 text-xs text-gray-400 border-t">© 2026 Tripura Career</div>
</footer>

<a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-all z-[99] text-2xl">
    <i class="fa-brands fa-whatsapp"></i>
</a>

</body>
</html>