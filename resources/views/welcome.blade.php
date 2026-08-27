<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tripura Career - Govt Jobs & Scholarships</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#f8faf8]">

<!-- TOP BAR like TIUT -->
<div class="bg-[#0a5c36] text-white text-[11px] py-1.5 px-6 lg:px-20 flex justify-between">
    <div><i class="fa fa-check-circle"></i> TRIPURA CAREER OFFICIAL 2026 - 100% Verified Updates</div>
    <div class="hidden md:block">Helpline: +91 7005xxxxxx | tripuracareer@gmail.com</div>
</div>

<!-- HEADER like TIUT screenshot -->
<div class="bg-white px-6 lg:px-20 py-3 flex justify-between items-center shadow-sm sticky top-0 z-50">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-[#0a5c36] rounded-lg flex items-center justify-center text-white font-black">T</div>
        <div>
            <h1 class="font-bold text-[18px] leading-none text-black">Tripura Career</h1>
            <p class="text-[9px] text-gray-500 tracking-widest">GOVT JOBS | SCHOLARSHIPS</p>
        </div>
        <div class="hidden lg:flex gap-2 ml-8 border-l pl-8">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Emblem_of_India.svg/120px-Emblem_of_India.svg.png" class="h-8">
            <span class="text-[10px] border px-2 py-1">UGC</span><span class="text-[10px] border px-2 py-1">TPSC</span><span class="text-[10px] border px-2 py-1">JRBT</span>
        </div>
    </div>
    <div class="flex items-center gap-6">
        <ul class="hidden md:flex gap-6 text-[13px] font-semibold">
            <li class="text-[#0a5c36]">Jobs</li><li>Scholarships</li><li>Admit Cards</li><li>About</li>
        </ul>
        <a href="#" class="bg-[#0a5c36] text-white px-5 py-2 rounded-full text-sm font-bold">Apply Now</a>
    </div>
</div>

<!-- HERO SLIDER - TIUT STYLE but YOUR CONTENT -->
<div class="relative mx-4 lg:mx-20 mt-6 rounded-[24px] overflow-hidden bg-[#0a5c36] h-[520px] flex" id="hero">
    <!-- Left Text Area -->
    <div class="w-full lg:w-[55%] p-10 lg:p-14 text-white flex flex-col justify-center relative z-10">
        <span class="bg-black text-white text-[10px] px-4 py-1.5 rounded-full w-fit mb-6 tracking-widest"><span class="w-2 h-2 bg-green-400 inline-block rounded-full mr-2"></span>TRIPURA CAREER OFFICIAL 2026</span>
        <h1 class="text-5xl font-black leading-[0.9]">Getting a <span class="text-[#ff8a3d]">Govt Job</span><br>Is Now Easier.</h1>
        <p class="mt-4 text-white/80 text-[14px]">TPSC, JRBT, Tripura Police, Health Dept and Scholarships. Get the fastest, 100% verified updates first.</p>

        <div class="mt-8 flex gap-3">
            <a href="#" class="bg-white text-black px-6 py-3 rounded-full text-sm font-bold">View All Jobs</a>
            <a href="#" class="bg-white/10 border border-white/30 text-white px-6 py-3 rounded-full text-sm">Scholarships</a>
        </div>
    </div>

    <!-- Right - TODAY'S TOP ALERTS Card like your screenshot but inside slider -->
    <div class="hidden lg:flex w-[45%] p-8 items-center">
        <div class="bg-white rounded-[20px] p-6 w-full shadow-2xl">
            <div class="flex justify-between items-center mb-4"><h3 class="font-bold text-sm">TODAY'S TOP ALERTS</h3><span class="bg-green-100 text-green-700 text-[10px] px-2 py-1 rounded-full">LIVE</span></div>
            @php $jobs = \App\Models\Job::latest()->take(3)->get(); @endphp
            @foreach($jobs as $job)
            <div class="border rounded-xl p-3 flex gap-3 mb-3">
                <div class="w-9 h-9 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-sm">{{ substr($job->title,0,1) }}</div>
                <div><p class="text-[13px] font-semibold line-clamp-1">{{ $job->title }}</p><p class="text-[11px] text-gray-500">5 hours ago</p></div>
            </div>
            @endforeach
            <a href="/jobs" class="bg-black text-white w-full block text-center py-3 rounded-xl text-sm font-bold mt-2">View All Jobs</a>
        </div>
    </div>

    <!-- Slider Arrows like TIUT video -->
    <button onclick="next()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow"><i class="fa fa-chevron-left text-xs"></i></button>
    <button onclick="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white w-10 h-10 rounded-full shadow"><i class="fa fa-chevron-right text-xs"></i></button>

    <!-- Green library bg overlay -->
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570')] opacity-10 mix-blend-overlay"></div>
</div>

<!-- Categories - Your 4 cards but TIUT style -->
<div class="px-6 lg:px-20 grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
    <div class="bg-white border rounded-2xl p-6"><div class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center mb-10">🏛️</div><h3 class="font-bold text-sm">TPSC Jobs</h3><p class="text-xs text-gray-500">4+ Active</p></div>
    <div class="bg-white border rounded-2xl p-6"><div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-10">👮</div><h3 class="font-bold text-sm">Police Jobs</h3><p class="text-xs text-gray-500">85+ Active</p></div>
    <div class="bg-white border rounded-2xl p-6"><div class="w-10 h-10 bg-purple-50 rounded-xl flex items-center justify-center mb-10">🎓</div><h3 class="font-bold text-sm">Scholarships</h3><p class="text-xs text-gray-500">4+ Active</p></div>
    <div class="bg-white border rounded-2xl p-6"><div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-10">📄</div><h3 class="font-bold text-sm">Admit Cards</h3><p class="text-xs text-gray-500">Live Now</p></div>
</div>

</body>
</html>