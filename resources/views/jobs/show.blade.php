@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
  <a href="{{ route('jobs.index') }}" class="text-sm font-bold mb-4 inline-block">← Back to Jobs</a>

  <div class="bg-white rounded-2xl border-l-4 border-l-orange-500 border shadow-sm p-6">
    <div class="flex justify-between items-start gap-2">
      <h1 class="font-black text-[17px] leading-5">{{ $job->title }}</h1>
      <span class="bg-green-100 text-green-700 text-[10px] font-black px-2.5 py-1 rounded-full">VERIFIED</span>
    </div>

    <p class="text-[11px] text-gray-500 mt-2">
      📍 {{ $job->location?? 'Tripura' }} | 🎓 {{ $job->qualification?? '10th Pass' }} | Deadline: {{ \Carbon\Carbon::parse($job->last_date?? $job->deadline)->format('d-m-Y') }}
    </p>

    <div class="mt-4 text-[13px] leading-6 bg-gray-50 p-4 rounded-xl whitespace-pre-line">
      {{ $job->description }}
    </div>

    {{-- IMPORTANT LINKS --}}
    <div class="grid grid-cols-2 gap-2 mt-5">
      @if($job->pdf_url?? $job->notification_link)
      <a href="{{ $job->pdf_url?? $job->notification_link }}" target="_blank" class="text-center border py-3 rounded-xl font-bold text-xs">📄 Official PDF</a>
      @endif
      <a href="{{ $job->apply_link?? $job->official_link?? 'https://tripura.gov.in' }}" target="_blank" class="text-center bg-black text-white py-3 rounded-xl font-black text-xs">
        Apply on Official Site →
      </a>
    </div>

    <div class="mt-3 flex gap-2">
      <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!')" class="flex-1 border py-2.5 rounded-full text-xs font-bold">📋 Copy Link</button>
      <a href="https://wa.me/?text={{ urlencode($job->title.' - '.url()->current()) }}" target="_blank" class="flex-1 text-center bg-green-500 text-white py-2.5 rounded-full text-xs font-bold">WhatsApp Share</a>
    </div>

    <div class="mt-4 bg-blue-50 border border-blue-200 p-3 rounded-xl text-[11px]">
      ⚠️ TripuraCareer sirf info deta hai, job official site pe hi apply hota hai. Kabhi bhi paise mat dena.
    </div>
  </div>
</div>
@endsection