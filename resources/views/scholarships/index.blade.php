@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-3 py-6">
<h1 class="font-black text-xl text-center mb-6">🎓 {{ $scholarships->count() }} Scholarships</h1>

@forelse($scholarships as $s)
<div class="bg-white rounded-2xl border p-4 mb-3 border-l-4 border-l-blue-500 shadow-sm">
<div class="flex justify-between items-start gap-2">
  <h3 class="font-bold text-[13px] leading-4">{{ $s->title }}</h3>
  <span class="bg-green-100 text-green-700 text-[10px] font-black px-2.5 py-1 rounded-full whitespace-nowrap">₹{{ $s->amount }}</span>
</div>
<p class="text-[11px] text-gray-500 mt-1">Dept: {{ $s->department?? $s->provider }} | Deadline: {{ \Carbon\Carbon::parse($s->deadline?? $s->last_date)->format('d-m-Y') }}</p>
<div class="mt-3 flex gap-2">

{{-- APPLY FIX --}}
<a href="{{ route('scholarships.show', $s->id) }}" class="text-xs bg-blue-600 text-white px-4 py-1.5 rounded-full font-bold">
  Apply →
</a>

{{-- SHARE FIX --}}
<button onclick="shareNow('{{ addslashes($s->title) }} - ₹{{ addslashes($s->amount) }}', '{{ url('/scholarships/'.$s->id) }}')"
   class="text-xs border px-3 py-1.5 rounded-full bg-gray-50 font-bold">
   📤 Share
</button>

</div>
</div>
@empty
<p class="text-center text-sm">No scholarships yet</p>
@endforelse
</div>

<script>
function shareNow(title, url){
    let text = title + " - Apply here: " + url;
    if(navigator.share){
        navigator.share({title: title, text: text, url: url});
    } else {
        window.open("https://wa.me/?text=" + encodeURIComponent(text), "_blank");
    }
}
</script>
@endsection