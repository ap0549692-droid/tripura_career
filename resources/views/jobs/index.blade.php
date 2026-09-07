@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto px-3 py-6">

<h1 class="font-black text-xl text-center"> {{ $jobs->count() }} Govt Jobs in Tripura</h1>
<p class="text-center text-xs text-gray-500 mt-1">Filter by your qualification</p>

{{-- VOICE SEARCH - NEW ADDED HERE --}}
<div class="mt-4 bg-white border rounded-2xl p-3 shadow-sm">
    <form action="{{ route('jobs.index') }}" method="GET" id="voiceSearchForm">
        {{-- Old filters ko bhi sath me bhejenge taaki filter na hatega --}}
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="qualification" value="{{ request('qualification') }}">

        <div class="relative flex items-center w-full">
            <input type="text" id="voiceSearchInput" name="q" value="{{ request('q') }}"
                   placeholder="Bolo - 'TPSC jobs' / 'Borok ni job' / 'আমার চাকরি লাগবে'"
                   class="w-full pl-4 pr-12 py-3 rounded-full border border-gray-300 text-[13px] font-semibold outline-none focus:border-orange-500 bg-gray-50">

            <button type="button" id="voiceBtn" onclick="startVoice()"
                    class="absolute right-1 bg-black text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-800">
                🎤
            </button>
        </div>
    </form>
    <p id="voiceStatus" class="text-[11px] text-gray-500 mt-2 ml-2 hidden font-bold">Sun raha hu... bolo</p>
</div>

{{-- CATEGORY FILTER - NEW --}}
<div class="flex gap-2 mt-4 overflow-x-auto pb-2">
  <a href="{{ route('jobs.index', ['qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')==''?'bg-blue-600 text-white':'bg-white' }}">All Jobs</a>
  <a href="{{ route('jobs.index', ['category'=>'Banking', 'qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Banking'?'bg-blue-600 text-white':'bg-white' }}">🏦 Banking</a>
  <a href="{{ route('jobs.index', ['category'=>'Defence', 'qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Defence'?'bg-blue-600 text-white':'bg-white' }}">🪖 Defence</a>
  <a href="{{ route('jobs.index', ['category'=>'Post Office', 'qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Post Office'?'bg-blue-600 text-white':'bg-white' }}">📮 Post Office</a>
  <a href="{{ route('jobs.index', ['category'=>'Railway', 'qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Railway'?'bg-blue-600 text-white':'bg-white' }}">🚂 Railway</a>
  <a href="{{ route('jobs.index', ['category'=>'Private', 'qualification'=>request('qualification'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('category')=='Private'?'bg-blue-600 text-white':'bg-white' }}">💼 Private</a>
</div>

{{-- ELIGIBILITY FILTER --}}
<div class="flex gap-2 mt-2 overflow-x-auto pb-2">
  <a href="{{ route('jobs.index', ['category'=>request('category'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')==''?'bg-black text-white':'' }}">All</a>
  <a href="{{ route('jobs.index', ['qualification'=>'10th', 'category'=>request('category'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='10th'?'bg-black text-white':'' }}">10th Pass</a>
  <a href="{{ route('jobs.index', ['qualification'=>'12th', 'category'=>request('category'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='12th'?'bg-black text-white':'' }}">12th Pass</a>
  <a href="{{ route('jobs.index', ['qualification'=>'Graduate', 'category'=>request('category'), 'q'=>request('q')]) }}" class="whitespace-nowrap border px-4 py-1.5 rounded-full text-xs font-bold {{ request('qualification')=='Graduate'?'bg-black text-white':'' }}">Graduate</a>
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
<p class="text-center text-sm mt-10">No jobs found for "{{ request('q') }}"</p>
@endforelse

</div>

<script>
function startVoice() {
    if (!('webkitSpeechRecognition' in window) &&!('SpeechRecognition' in window)) {
        alert("Voice search Chrome me kaam karta hai, Chrome me kholo bhai");
        return;
    }
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();

    let currentLang = localStorage.getItem('trip_lang') || 'en';
    if(currentLang === 'bn') recognition.lang = 'bn-IN';
    else recognition.lang = 'en-IN'; // en-IN will handle English + Kokborok (Hinglish) best

    recognition.interimResults = false;
    const btn = document.getElementById('voiceBtn');
    const status = document.getElementById('voiceStatus');
    const input = document.getElementById('voiceSearchInput');

    recognition.onstart = () => {
        btn.innerHTML = "🔴";
        btn.classList.add('animate-pulse');
        status.classList.remove('hidden');
        if(currentLang === 'en') status.innerText = "Listening... say 'TPSC jobs' or 'Police jobs'";
        else if(currentLang === 'bn') status.innerText = "শুনছি... বলো - 'পুলিশের চাকরি'";
        else status.innerText = "Kna thang di... 'Borok ni job' sah di";
    };
    recognition.onresult = (event) => {
        const text = event.results[0][0].transcript;
        input.value = text;
        status.innerText = "Mil gaya: '" + text + "' - Search kar raha hu...";
        setTimeout(() => { document.getElementById('voiceSearchForm').submit(); }, 600);
    };
    recognition.onerror = () => { status.innerText = "Awaz clear nahi aayi, fir se bolo bhai"; };
    recognition.onend = () => { btn.innerHTML = "🎤"; btn.classList.remove('animate-pulse'); };
    recognition.start();
}
</script>
@endsection