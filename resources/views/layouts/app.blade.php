<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Tripura Jobs & Scholarships 2026 - Govt Jobs, Scholarships, PRTC Jobs, 10th 12th Pass')</title>
    <meta name="description" content="Latest Tripura Govt Jobs 2026 - TPSC, JRBT, Tripura Police, 10th 12th Pass jobs. No fake. PRTC verified. AI help available.">
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
     .main-bg { background-color: #f8fafc; background-image: radial-gradient(at 20% 20%, hsla(28,100%,74%,0.15) 0px, transparent 50%), radial-gradient(at 80% 20%, hsla(189,100%,56%,0.15) 0px, transparent 50%), radial-gradient(at 50% 80%, hsla(355,100%,93%,0.4) 0px, transparent 50%); min-height: 100vh; }
     .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.7); }
     .nav-glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0,0,0,0.05); }
     .no-scrollbar::-webkit-scrollbar{display:none}.no-scrollbar{ -ms-overflow-style:none; scrollbar-width:none; }
    </style>
</head>
<body class="main-bg">
@php use Illuminate\Support\Facades\Auth; @endphp

<nav class="nav-glass shadow-sm p-4 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <a href="/" class="font-extrabold text-[22px] uppercase tracking-[1.5px]">🔥 <span class="text-orange-600">Tripura</span> Career</a>
        <ul class="flex gap-3 md:gap-6 font-semibold text-sm items-center">
            <li><a href="/" class="hover:text-orange-600">Home</a></li>
            <li><a href="/jobs">Govt Jobs</a></li>
            <li><a href="/scholarships">Scholarships</a></li>
            <li><a href="/admit-cards" class="hover:text-orange-500 hidden md:block">Admit Cards</a></li>
            @if(Auth::check())
                <li class="hidden md:block text-gray-700">Hi, {{ Auth::user()->name }}</li>
                <li><a href="/dashboard" class="bg-black text-white px-5 py-2.5 rounded-full"><i class="fa-solid fa-gauge-high mr-1"></i> Dashboard</a></li>
                <li><a href="/logout" class="bg-red-500 text-white px-4 py-2 rounded-full">Logout</a></li>
            @else
                <li><a href="/login" class="px-3">Login</a></li>
                <li><a href="/register" class="bg-black text-white px-5 py-2.5 rounded-full">Register</a></li>
            @endif
        </ul>
    </div>
</nav>

<div class="max-w-7xl mx-auto mt-8 px-4 pb-10 min-h-[70vh]">
    @yield('content')
</div>

<footer class="mt-20 border-t glass-card">
    <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-2 gap-8 text-sm">
        <div>
            <h3 class="font-extrabold text-lg uppercase tracking-[1.5px]">🔥 Tripura Career</h3>
            <p class="text-gray-500 mt-2">Tripura's fastest & verified portal for Govt Jobs and Scholarships. Now with AI Assistant.</p>
            <a href="/" class="mt-4 inline-flex items-center gap-2 border px-4 py-2 rounded-full font-bold"><i class="fa fa-arrow-left"></i> Back to Home</a>
            <div class="flex gap-3 mt-4">
                <a href="https://www.facebook.com/profile.php?id=61593295217124" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/tripura_career/" target="_blank" class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 text-white rounded-full flex items-center justify-center"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        <div>
            <h4 class="font-bold">Join Our Community</h4>
            <p class="mt-2 text-gray-600">Get daily updates on WhatsApp, Facebook & Instagram:</p>
            <a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="mt-3 inline-flex items-center gap-2 bg-green-500 text-white px-5 py-2.5 rounded-full font-bold"><i class="fa-brands fa-whatsapp text-lg"></i> Join WhatsApp Group</a>
        </div>
    </div>
    <div class="text-center py-4 text-xs text-gray-400 border-t">© 2026 Tripura Career - AI Powered</div>
</footer>

{{-- WHATSAPP BUTTON RIGHT --}}
<a href="https://chat.whatsapp.com/CTRTXzJ2XhQ9d105zjXQFp" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl text-2xl z-[60]">
    <i class="fa-brands fa-whatsapp"></i>
</a>

{{-- AI ASSISTANT WIDGET LEFT --}}
<div id="aiWidget">
  <button id="aiBtn" class="fixed bottom-6 left-6 bg-black text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center text-xl z-[60] border-2 border-white">🤖</button>
  <div id="aiBox" class="hidden fixed bottom-24 left-6 w-[350px] max-w-[92vw] bg-white rounded-[20px] shadow-2xl border z-[60] overflow-hidden">
    <div class="bg-black text-white p-4 flex justify-between items-center">
      <div><h3 class="font-black text-sm">Tripura Career AI 🤖</h3><p class="text-[10px] opacity-70">Kokborok | বাংলা | English - 24/7 Help</p></div>
      <button onclick="document.getElementById('aiBox').classList.add('hidden')" class="w-7 h-7 bg-white/20 rounded-full">✕</button>
    </div>
    <div id="aiChat" class="h-[320px] overflow-y-auto p-3 space-y-2.5 text-[12.5px] bg-[#fafafa]">
      <div class="bg-white border rounded-2xl rounded-bl-none p-3 shadow-sm">Hello! I am your Career Assistant 🙏<br>Ask me about: <b>PRTC, 10th Jobs, TPSC, Last Date, Scholarship, Login Issues</b><br><span class="text-[10px] text-gray-500">I can solve any portal problem 24/7</span></div>
    </div>
    <div class="p-2.5 border-t flex gap-2 bg-white">
      <input id="aiInput" placeholder="Type your doubt here..." class="flex-1 border rounded-full px-4 py-2.5 text-xs outline-none focus:border-black">
      <button id="aiSend" class="bg-black text-white px-5 rounded-full text-xs font-bold">Send</button>
    </div>
    <div class="p-2 flex gap-1.5 flex-wrap border-t bg-gray-50">
      <button onclick="askAI('PRTC kya hai?')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">PRTC?</button>
      <button onclick="askAI('10th pass job')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">10th Jobs</button>
      <button onclick="askAI('12th pass job')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">12th Jobs</button>
      <button onclick="askAI('TPSC eligibility')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">TPSC</button>
      <button onclick="askAI('Kokborok te kok sa')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">Kokborok</button>
      <button onclick="askAI('Scholarship')" class="text-[10px] bg-white border px-2.5 py-1 rounded-full font-bold">Scholarship</button>
    </div>
  </div>
</div>

<script>
const aiBtn = document.getElementById('aiBtn');
const aiBox = document.getElementById('aiBox');
aiBtn.onclick = () => aiBox.classList.toggle('hidden');
function askAI(q){ document.getElementById('aiInput').value=q; sendAI(); }

async function sendAI(){
  let input = document.getElementById('aiInput');
  let chat = document.getElementById('aiChat');
  let q = input.value.trim(); if(!q) return;
  chat.innerHTML += `<div class="bg-black text-white rounded-2xl rounded-br-none p-3 ml-10 text-right">${q}</div>`;
  input.value='';
  chat.innerHTML += `<div id="typing" class="bg-white border rounded-2xl p-3 mr-6 text-gray-400">AI is typing...</div>`;
  chat.scrollTop = chat.scrollHeight;
  try {
    const res = await fetch('/api/ai-chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify({ message: q })
    });
    const data = await res.json();
    document.getElementById('typing')?.remove();
    chat.innerHTML += `<div class="bg-white border rounded-2xl rounded-bl-none p-3 mr-6 shadow-sm leading-relaxed">${data.reply}</div>`;
  } catch(e) {
    document.getElementById('typing')?.remove();
    chat.innerHTML += `<div class="bg-white border rounded-2xl p-3 mr-6">Error! <a href='/jobs' class='text-blue-600 underline'>Browse Jobs</a></div>`;
  }
  chat.scrollTop = chat.scrollHeight;
}
document.getElementById('aiSend').onclick = sendAI;
document.getElementById('aiInput').addEventListener('keypress', e=>{ if(e.key==='Enter') sendAI(); });
</script>

</body>
</html>