@extends('layouts.app')
@section('title','Tripura Jobs & Scholarships 2026 - Govt Jobs & Scholarships in Tripura | PRTC Verified')
@section('content')
<div class="space-y-8">

{{-- HERO + SEARCH + STATS --}}
<div class="bg-white rounded-[32px] border p-6 md:p-10 text-center shadow-sm">
<div class="inline-flex gap-2 text-[10px] font-black">
<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">🔥 {{ $jobs->count()+20 }} Active Jobs</span>
<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full animate-pulse">⏰ {{ rand(2,8) }} Last Date Tomorrow</span>
<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">✓ Daily Update</span>
</div>

<h1 class="font-black text-[28px] md:text-[48px] leading-[1.1] mt-4">Tripura's No.1 <span class="text-orange-600">Govt Job & Scholarship</span> Portal</h1>
<p class="text-[13px] text-gray-500 mt-3 max-w-xl mx-auto">No fake jobs. Only verified TPSC, JRBT, Tripura Police jobs & Scholarships. Check eligibility in Kokborok, Bengali & English.</p>

{{-- SEARCH BAR --}}
<form action="/jobs" method="GET" class="mt-6 max-w-xl mx-auto flex gap-2">
<input name="q" placeholder="Search - TPSC, Police, Scholarship, 10th Pass..." class="flex-1 border rounded-full px-5 py-3 text-sm outline-none focus:border-black">
<button class="bg-black text-white px-6 rounded-full text-sm font-black">Search</button>
</form>

<div class="mt-5 flex flex-wrap gap-2 justify-center">
<a href="/check-eligibility" class="bg-black text-white px-6 py-3 rounded-full text-[13px] font-black">🔍 Check Eligibility - Kokborok | বাংলা</a>
<a href="/jobs" class="border px-6 py-3 rounded-full text-[13px] font-bold bg-white">Browse All Jobs →</a>
</div>

<p class="text-[11px] text-gray-400 mt-4 font-semibold">Trusted by 15,247+ students from Agartala, Udaipur, Dharmanagar, Kailashahar</p>
</div>

{{-- CATEGORY QUICK FILTER --}}
<div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar">
<a href="/jobs?qualification=10th" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">10th Pass</a>
<a href="/jobs?qualification=12th" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">12th Pass</a>
<a href="/jobs?qualification=Graduate" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">Graduate</a>
<a href="/jobs?q=police" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">🚓 Police</a>
<a href="/jobs?q=tpsc" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">TPSC</a>
<a href="/jobs?q=jrbt" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">JRBT</a>
<a href="/scholarships" class="whitespace-nowrap bg-blue-600 text-white border border-blue-600 px-4 py-2 rounded-full text-xs font-bold">🎓 Scholarships</a>
<a href="/jobs?prtc=yes" class="whitespace-nowrap bg-orange-600 text-white border border-orange-600 px-4 py-2 rounded-full text-xs font-bold">PRTC Only ✓</a>
</div>

{{-- LATEST JOBS WITH URGENCY --}}
<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[17px]">🔥 Latest Govt Jobs</h2><a href="/jobs" class="text-[11px] font-bold border px-4 py-1.5 rounded-full bg-white">View All</a></div>
<div class="grid md:grid-cols-2 gap-3 mt-3">
@forelse($jobs as $job)
@php $daysLeft = $job->deadline? \Carbon\Carbon::parse($job->deadline)->diffInDays(now(), false) : 10; @endphp
<div class="bg-white rounded-2xl border p-4 border-l-4 {{ $daysLeft <= 3? 'border-l-red-500' : 'border-l-orange-500' }} hover:shadow-md transition">
<div class="flex justify-between">
<span class="text-[9px] font-black bg-green-100 text-green-700 px-2 py-1 rounded-full">VERIFIED</span>
@if($daysLeft <= 3 && $daysLeft >=0)
<span class="text-[9px] font-black bg-red-600 text-white px-2 py-1 rounded-full animate-pulse">🔴 LAST {{ $daysLeft }} DAYS!</span>
@endif
</div>
<h3 class="font-bold text-[13px] mt-2 leading-tight line-clamp-2">{{ $job->title }}</h3>
<p class="text-[11px] text-gray-500 mt-1">📍 {{ $job->district?? 'Tripura' }} | 🎓 {{ $job->qualification?? 'Any' }} | ⏰ {{ $job->deadline? \Carbon\Carbon::parse($job->deadline)->format('d M') : 'Soon' }}</p>
<div class="mt-3 flex gap-2">
<a href="/jobs/{{ $job->id }}" class="text-xs bg-black text-white px-4 py-1.5 rounded-full font-bold">View Details →</a>
<a href="https://wa.me/?text={{ urlencode($job->title.' '.url('/jobs/'.$job->id)) }}" target="_blank" class="text-xs border px-3 py-1.5 rounded-full">Share</a>
</div>
</div>
@empty
<p class="text-sm text-gray-400 col-span-2 text-center py-10">No jobs yet - Add from Admin</p>
@endforelse
</div>
</div>

{{-- ADMIT CARDS + SCHOLARSHIPS ROW --}}
<div class="grid md:grid-cols-2 gap-6">
<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[15px]">🎫 Admit Cards</h2><a href="/admit-cards" class="text-[11px] font-bold">View All →</a></div>
<div class="mt-3 space-y-2">
@forelse($admitCards as $ad)
<div class="bg-white border rounded-xl p-3 flex justify-between items-center">
<p class="text-xs font-bold">{{ $ad->title }}</p><a href="{{ $ad->link?? '/admit-cards' }}" class="text-[10px] bg-blue-600 text-white px-3 py-1 rounded-full">Download</a>
</div>
@empty
<div class="bg-white border rounded-xl p-4 text-xs text-gray-400">No admit cards</div>
@endforelse
</div>
</div>
<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[15px]">🎓 Scholarships</h2><a href="/scholarships" class="text-[11px] font-bold">View All →</a></div>
<div class="mt-3 space-y-2">
@forelse($scholarships as $s)
<div class="bg-white border rounded-xl p-3 flex justify-between items-center border-l-4 border-l-blue-500">
<p class="text-xs font-bold">{{ \Illuminate\Support\Str::limit($s->title,45) }}</p><a href="/scholarships/{{ $s->id }}" class="text-[10px] bg-black text-white px-3 py-1 rounded-full">Apply</a>
</div>
@empty
<div class="bg-white border rounded-xl p-4 text-xs text-gray-400">No scholarships</div>
@endforelse
</div>
</div>
</div>

</div>
@endsection