<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tripura Career</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-100 via-white to-cyan-100 flex items-center justify-center px-4">

<div class="w-full max-w-md">

    {{-- LOGO --}}
    <div class="text-center mb-6">
        <a href="{{ route('home') }}" class="text-3xl font-extrabold">
            🔥 <span class="text-orange-600">Tripura</span> Career
        </a>
        <p class="text-gray-500 mt-2">Create your free account</p>
    </div>

    {{-- REGISTER CARD --}}
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white p-8">

        <h1 class="text-2xl font-extrabold text-center">Create Account 🚀</h1>
        <p class="text-center text-gray-500 text-sm mt-2">Join Tripura Career</p>

        @if($errors->any())
            <div class="mt-5 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="mt-6 space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="block font-semibold text-sm mb-2">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block font-semibold text-sm mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            {{-- PASSWORD WITH EYE --}}
            <div>
                <label class="block font-semibold text-sm mb-2">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Minimum 6 characters" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-orange-400">
                    <button type="button" onclick="toggleEye('password','eyeIcon1')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black">
                        <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- CONFIRM PASSWORD WITH EYE --}}
            <div>
                <label class="block font-semibold text-sm mb-2">Confirm Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Repeat your password" required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 pr-12 outline-none focus:ring-2 focus:ring-orange-400">
                    <button type="button" onclick="toggleEye('password_confirmation','eyeIcon2')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-black">
                        <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-black text-white font-bold py-3.5 rounded-xl hover:bg-orange-600 transition">
                🚀 Create Account
            </button>
        </form>

        <div class="text-center mt-6 text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:underline">Login</a>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-orange-600">← Back to Home</a>
    </div>
</div>

<script>
function toggleEye(inputId, iconId){
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if(input.type === 'password'){
        input.type = 'text';
        // change to eye-off icon
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
    }
}
</script>

</body>
</html>