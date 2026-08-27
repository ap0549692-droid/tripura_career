@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-3 py-6">

<h1 class="font-black text-xl text-center"> {{ $jobs->count() }} Govt Jobs in Tripura</h1>
<p class="text-center text-xs text-gray-500 mt-1">Filter by your qualification</p>

{{-- CATEGORY FILTER - NEW --}}
<div class="flex gap-2 mt-4 overflow-x-auto pb-2">
  <a href="{{ route('jobs.index', ['qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')==''?'bg-blue-600 text-white':'bg-white' }}">All Jobs</a>
  <a href="{{ route('jobs.index', ['category'=>'Banking', 'qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Banking'?'bg-blue-600 text-white':'bg-white' }}">🏦 Banking</a>
  <a href="{{ route('jobs.index', ['category'=>'Defence', 'qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Defence'?'bg-blue-600 text-white':'bg-white' }}">🪖 Defence</a>
  <a href="{{ route('jobs.index', ['category'=>'Post Office', 'qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Post Office'?'bg-blue-600 text-white':'bg-white' }}">📮 Post Office</a>
  <a href="{{ route('jobs.index', ['category'=>'Railway', 'qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Railway'?'bg-blue-600 text-white':'bg-white' }}">🚂 Railway</a>
  <a href="{{ route('jobs.index', ['category'=>'Private', 'qualification'=>request('qualification')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Private'?'bg-blue-600 text-white':'bg-white' }}">💼 Private</a>
</div>

{{-- ELIGIBILITY FILTER --}}
<div class="flex gap-2 mt-2 overflow-x-auto pb-2">
  <a href="{{ route('jobs.index', ['category'=>request('category')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')==''?'bg-black text-white':'' }}">All</a>
  <a href="{{ route('jobs.index', ['qualification'=>'10th', 'category'=>request('category')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='10th'?'bg-black text-white':'' }}">10th Pass</a>
  <a href="{{ route('jobs.index', ['qualification'=>'12th', 'category'=>request('category')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='12th'?'bg-black text-white':'' }}">12th Pass</a>
  <a href="{{ route('jobs.index', ['qualification'=>'Graduate', 'category'=>request('category')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='Graduate'?'bg-black text-white':'' }}">Graduate</a>
</div>

@forelse($jobs as $job)
<div class="bg-white rounded-2xl border p-4 mb-3 border-l-4 border-l-orange-500 shadow-sm">
  <div class="flex justify-between items-start gap-2">
    <h3 class="font-bold text-[13px] leading-4">{{ $job->title }}</h3>
    <span class="bg-green-100 text-green-700 text-[9px] font-black px-2 py-1 rounded-full">VERIFIED</span>
  </div>
  <p class="text-[11px] text-gray-500 mt-1">
    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-bold">{{ $job->category?? $job->department }}</span> |
    {{ $job->department }} | Deadline: {{ \Carbon\Carbon::parse($job->deadline?? $job->last_date)->format('d-m-Y') }}
  </p>
  <div class="mt-3 flex gap-2">
    <a href="{{ route('jobs.show', $job->id) }}" class="text-xs bg-black text-white px-4 py-1.5 rounded-full font-bold">View Details →</a>
  </div>
</div>
@empty
<p class="text-center text-sm mt-10">No jobs found</p>
@endforelse

</div>
@endsection