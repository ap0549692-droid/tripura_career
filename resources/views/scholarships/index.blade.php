<!DOCTYPE html><html><head><script src="https://cdn.tailwindcss.com"></script></head>
<body style="background: linear-gradient(135deg, #fffaf0 0%, #e6f6ff 100%);">
<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold">Latest <span style="color:orange">Scholarships</span> 2026</h1>
    <div class="mt-8 space-y-5">
       @foreach($scholarships as $sch)
       <div class="bg-white rounded-xl border-l-4 border-blue-400 p-5 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex gap-2 mb-2">
                <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-3 py-1 rounded-full">{{ $sch->provider?? 'Scholarship' }}</span>
                <span class="bg-red-50 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full">Last: {{ $sch->last_date }}</span>
            </div>
            <h3 class="font-bold text-[15px]">{{ $sch->title }}</h3>
            <p class="text-xs text-gray-500 mt-1">{{ Str::limit($sch->description, 100) }}</p>
            <div class="mt-3 flex gap-2"><span class="text-xs border px-4 py-1.5 rounded-full">Details</span><a href="{{ $sch->apply_link }}" target="_blank" class="text-xs bg-blue-500 text-white px-5 py-1.5 rounded-full font-bold">Apply Now →</a></div>
       </div>
       @endforeach
    </div>
</div>
</body></html>