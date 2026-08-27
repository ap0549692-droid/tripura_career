@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-3 py-6">
<h1 class="text-center font-black text-xl mb-6">🎫 {{ $admitCards instanceof \Illuminate\Pagination\LengthAwarePaginator ? $admitCards->total() : $admitCards->count() }} Latest Admit Cards</h1>

@forelse($admitCards as $card)
<div class="bg-white rounded-2xl border shadow-sm p-4 mb-4 border-l-4 border-l-green-500 hover:shadow-md transition">
  <div class="flex justify-between items-center">
    <span class="text-[10px] font-black bg-green-100 text-green-700 px-2.5 py-1 rounded-full">ADMIT CARD</span>
    <span class="text-[11px] font-bold bg-gray-900 text-white px-2.5 py-1 rounded-full">Exam: {{ $card->exam_date?? 'Soon' }}</span>
  </div>
  <h2 class="font-bold text-[14px] mt-3 leading-tight">{{ $card->title }}</h2>
  <div class="mt-3">
    <a href="{{ $card->download_link }}" target="_blank" class="text-xs font-bold bg-green-600 text-white px-5 py-2 rounded-full">Download Admit Card →</a>
  </div>
</div>
@empty
<div class="text-center p-10 bg-white rounded-2xl">No Admit Cards Found - Will be updated soon</div>
@endforelse

<div class="mt-6">{{ $admitCards->links() }}</div>
</div>
@endsection