@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto px-4 mt-10">
<div class="bg-white rounded-2xl shadow-xl p-7 border">
<h1 class="font-black text-2xl">PRTC Eligibility Checker</h1>
<p class="text-sm text-gray-500 mt-1">Kisi bhi job ke liye check karo</p>
<input id="age" type="number" placeholder="Your Age" class="w-full border rounded-full px-4 py-3 mt-5 outline-none focus:ring-2 focus:ring-orange-500">
<select id="prtc" class="w-full border rounded-full px-4 py-3 mt-3"><option value="yes">PRTC Yes</option><option value="no">PRTC No</option></select>
<button onclick="let a=parseInt(document.getElementById('age').value);let p=document.getElementById('prtc').value;let r=document.getElementById('result');r.classList.remove('hidden');if(!a){r.innerText='Age daalo';r.className='mt-5 p-4 rounded-xl text-center font-bold bg-yellow-50 text-yellow-700';return;}if(a<18||a>40){r.innerText='❌ Not Eligible - Age 18-40 chahiye';r.className='mt-5 p-4 rounded-xl text-center font-bold bg-red-50 text-red-600 border';return;}if(p=='no'){r.innerText='⚠️ PRTC Required hai';r.className='mt-5 p-4 rounded-xl text-center font-bold bg-orange-50 text-orange-600 border';return;}r.innerHTML='✅ Eligible Ho! <br><a href=/jobs class=text-xs underline>View Jobs →</a>';r.className='mt-5 p-4 rounded-xl text-center font-bold bg-green-50 text-green-700 border';"
class="w-full bg-orange-500 text-white rounded-full py-3 mt-5 font-bold">Check Now</button>
<div id="result" class="hidden mt-5 p-4 rounded-xl text-center font-bold text-sm"></div>
<a href="/jobs" class="block text-center mt-4 text-sm font-bold text-gray-600">← Back to Jobs</a>
</div>
</div>
@endsection