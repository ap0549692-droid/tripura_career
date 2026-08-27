@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
  <a href="{{ route('scholarships.index') }}" class="text-sm font-bold mb-4 inline-block">← Back</a>

  <div class="bg-white rounded-2xl border-l-4 border-l-blue-600 border shadow-sm p-6">
    <div class="flex justify-between items-start gap-3">
      <h1 class="font-black text-[18px] leading-6">{{ $scholarship->title }}</h1>
      <span class="bg-green-100 text-green-700 text-xs font-black px-3 py-1.5 rounded-full whitespace-nowrap">
        ₹{{ $scholarship->amount }}
      </span>
    </div>

    <p class="text-[12px] text-gray-500 mt-3">
      Department: {{ $scholarship->department?? $scholarship->provider }} | Deadline: {{ $scholarship->deadline?? $scholarship->last_date }}
    </p>

    <div class="mt-4 text-[13px] leading-6 bg-gray-50 p-4 rounded-xl">
      {{ $scholarship->description }}
    </div>

    <div class="mt-4 bg-yellow-50 border border-yellow-200 p-3 rounded-xl text-[11px]">
      ⚠️ Note: NSP ka direct link `.../NEC_Merit` ab kaam nahi karta (404 aata hai). Official portal pe jaake scheme search karna padta hai.
    </div>

    <a href="{{ $scholarship->apply_link?? $scholarship->link?? 'https://scholarships.gov.in' }}" target="_blank" class="block text-center mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-black text-sm">
      Apply on Official NSP Portal →
    </a>

    <div class="mt-3 flex gap-2">
      <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!')" class="flex-1 border py-2.5 rounded-full text-xs font-bold">📋 Copy Link</button>
      <a href="https://wa.me/?text={{ urlencode($scholarship->title.' - ₹'.$scholarship->amount.' - '.url()->current()) }}" target="_blank" class="flex-1 text-center border py-2.5 rounded-full text-xs font-bold bg-green-50">📤 WhatsApp Share</a>
    </div>
  </div>
</div>
@endsection