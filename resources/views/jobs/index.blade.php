<!DOCTYPE html><html><head><script src="https://cdn.tailwindcss.com"></script></head>
<body style="background: linear-gradient(135deg, #fffaf0 0%, #e6f6ff 100%);">
<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold">Latest Tripura <span style="color:orange">Govt Jobs</span> 2026</h1>
    <div class="mt-8 space-y-5">
       @foreach($jobs as $job)
       <div class="bg-white rounded-xl border-l-4 border-orange-400 p-5 shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
            <div class="flex gap-2 mb-2">
                <span class="bg-orange-50 text-orange-600 text-[10px] font-bold px-3 py-1 rounded-full">{{ $job->department }}</span>
                <span class="bg-red-50 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full">Last: {{ $job->last_date }}</span>
            </div>
            <h3 class="font-bold text-[15px]">{{ $job->title }}</h3>
            <div class="mt-3 flex gap-2"><span class="text-xs border px-4 py-1.5 rounded-full">Notification</span><a href="{{ $job->apply_link }}" target="_blank" class="text-xs bg-orange-500 text-white px-5 py-1.5 rounded-full font-bold">Apply Now →</a></div>
       </div>
       @endforeach
    </div>
</div>
</body></html>