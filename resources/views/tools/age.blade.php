@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto px-4 mt-10">
<div class="bg-white rounded-2xl shadow-xl p-7 border">
<h1 class="font-black text-2xl">Age Calculator 🧮</h1>
<p class="text-sm text-gray-500">TPSC / JRBT ke liye exact age</p>
<input type="date" id="dob" class="w-full border rounded-full px-4 py-3 mt-5">
<input type="date" id="cutoff" value="2026-01-01" class="w-full border rounded-full px-4 py-3 mt-3">
<button onclick="let d=new Date(document.getElementById('dob').value);let c=new Date(document.getElementById('cutoff').value);let diff=c-d;let age=Math.floor(diff/31557600000);let m=Math.floor((diff%31557600000)/2628000000);let r=document.getElementById('ageRes');r.classList.remove('hidden');r.innerHTML='Your Age: '+age+' Years, '+m+' Months<br><span class=text-xs>'+(age>=18&&age<=40?'Eligible ✅':'Not Eligible ❌')+'</span>';"
class="w-full bg-black text-white rounded-full py-3 mt-4 font-bold">Calculate Age</button>
<div id="ageRes" class="hidden mt-5 p-4 rounded-xl bg-blue-50 text-blue-700 font-bold text-center"></div>
</div>
</div>
@endsection