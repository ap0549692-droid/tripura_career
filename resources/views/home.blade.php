<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tripura Career - Govt Jobs & Scholarships</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Plus Jakarta Sans', sans-serif; background:#fafaf9;}</style>
</head>
<body>
    <nav class="bg-white border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2 font-black text-xl"><span class="bg-orange-600 text-white w-8 h-8 rounded-lg flex items-center justify-center">T</span> Tripura Career</div>
            <div class="flex gap-6 text-sm font-bold">
                <a href="{{ route('jobs.index') }}" class="hover:text-orange-600">Jobs</a>
                <a href="{{ route('scholarships.index') }}" class="hover:text-orange-600">Scholarships</a>
                <a href="/admit-cards" class="hover:text-orange-600">Admit Cards</a>
                <a href="{{ route('about') }}" class="hover:text-orange-600">About</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="rounded-[32px] p-8 md:p-14 border border-orange-100" style="background: radial-gradient(1200px 600px at 10% -10%, #ffedd5, transparent), radial-gradient(1000px 500px at 90% 0%, #fef3c7, transparent);">
            <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded-full text-[11px] font-bold tracking-widest">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span> TRIPURA CAREER OFFICIAL 2026
                    </div>
                    <h1 class="text-[38px] md:text-[58px] font-black leading-[0.95] mt-6 tracking-tight">
                        Getting a <span class="text-orange-600">Govt Job</span> <br> Is Now Easier.
                    </h1>
                    <p class="text-gray-600 mt-5 text-[15px] md:text-[17px] leading-relaxed max-w-xl">
                        TPSC, JRBT, Tripura Police, Health Dept and Scholarships. Get the fastest, 100% verified updates first.
                    </p>
                </div>
                <div class="flex-1 w-full max-w-[420px]">
                    <div class="bg-white/80 backdrop-blur-xl rounded-[24px] p-5 shadow-2xl border">
                        <div class="flex justify-between items-center">
                            <h3 class="font-black text-sm tracking-widest">TODAY'S TOP ALERTS</h3>
                            <span class="bg-green-100 text-green-700 text-[10px] px-2 py-1 rounded-full font-bold">LIVE</span>
                        </div>
                        <div class="mt-5 space-y-3">
                            @forelse($jobs->take(3) as $job)
                            <div class="bg-white border rounded-xl p-4 flex gap-3 items-center">
                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center font-black text-orange-600">{{ substr($job->title,0,1) }}</div>
                                <div class="flex-1"><p class="font-bold text-sm">{{ \Illuminate\Support\Str::limit($job->title, 25) }}</p><p class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</p></div>
                            </div>
                            @empty
                            <p class="text-xs text-gray-500">No jobs yet</p>
                            @endforelse
                        </div>
                        <a href="{{ route('jobs.index') }}" class="mt-4 block text-center bg-black text-white py-3 rounded-xl font-bold text-sm">View All Jobs</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CATEGORY CARDS -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
            <a href="{{ route('jobs.index') }}" class="group bg-white border border-gray-200 p-6 rounded-[20px] hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-xl">🏛️</div>
                <h3 class="font-black mt-4 text-[15px]">TPSC Jobs</h3>
                <p class="text-xs text-gray-500 mt-1 font-bold">{{ $jobs->count() }}+ Active</p>
            </a>
            <a href="{{ route('jobs.index') }}" class="group bg-white border border-gray-200 p-6 rounded-[20px] hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl">👮</div>
                <h3 class="font-black mt-4 text-[15px]">Police Jobs</h3>
                <p class="text-xs text-gray-500 mt-1 font-bold">85+ Active</p>
            </a>
            <a href="{{ route('scholarships.index') }}" class="group bg-white border border-gray-200 p-6 rounded-[20px] hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-xl">🎓</div>
                <h3 class="font-black mt-4 text-[15px]">Scholarships</h3>
                <p class="text-xs text-gray-500 mt-1 font-bold">{{ $scholarships->count() }}+ Active</p>
            </a>
            <a href="/admit-cards" class="group bg-white border border-gray-200 p-6 rounded-[20px] hover:shadow-xl hover:-translate-y-1 transition-all">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-xl">📄</div>
                <h3 class="font-black mt-4 text-[15px]">Admit Cards</h3>
                <p class="text-xs text-gray-500 mt-1 font-bold">Live Now</p>
            </a>
        </div>

        <!-- REAL JOBS -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black">Latest Govt Jobs</h2>
                <a href="{{ route('jobs.index') }}" class="text-sm font-bold text-orange-600">View All →</a>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($jobs as $job)
                    <div class="bg-white border rounded-2xl p-5 hover:shadow-lg transition">
                        <span class="bg-orange-100 text-orange-700 text-[10px] px-2 py-1 rounded-full font-bold">GOVT JOB</span>
                        <h3 class="font-bold mt-3 text-[15px] leading-tight">{{ $job->title }}</h3>
                        <p class="text-xs text-gray-500 mt-2">{{ \Illuminate\Support\Str::limit($job->description, 60) }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="mt-4 block text-center bg-black text-white py-2.5 rounded-xl text-xs font-bold">View Details</a>
                    </div>
                @empty
                    <p class="col-span-4 text-gray-500">No jobs found.</p>
                @endforelse
            </div>
        </div>

        <!-- LATEST ADMIT CARDS - NEW SECTION -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black">Latest Admit Cards</h2>
                <a href="/admit-cards" class="text-sm font-bold text-green-600">View All →</a>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($admitCards?? [] as $card)
                    <div class="bg-white border rounded-2xl p-5 hover:shadow-lg transition border-l-4 border-l-green-500">
                        <span class="bg-green-100 text-green-700 text-[10px] px-2 py-1 rounded-full font-bold">ADMIT CARD</span>
                        <h3 class="font-bold mt-3 text-[15px] leading-tight">{{ $card->title }}</h3>
                        <p class="text-xs text-gray-500 mt-2">{{ $card->department }} | {{ $card->exam_date }}</p>
                        <a href="{{ $card->admit_link }}" target="_blank" class="mt-4 block text-center bg-black text-white py-2.5 rounded-xl text-xs font-bold">Download Now</a>
                    </div>
                @empty
                    <p class="col-span-4 text-gray-500">No admit cards found. <a href="/admin/admit-cards" class="text-green-600 font-bold">Add Now</a></p>
                @endforelse
            </div>
        </div>

        <!-- REAL SCHOLARSHIPS -->
        <div class="mt-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black">Latest Scholarships</h2>
                <a href="{{ route('scholarships.index') }}" class="text-sm font-bold text-purple-600">View All →</a>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($scholarships as $scholarship)
                    <div class="bg-white border rounded-2xl p-5 hover:shadow-lg transition">
                        <span class="bg-purple-100 text-purple-700 text-[10px] px-2 py-1 rounded-full font-bold">SCHOLARSHIP</span>
                        <h3 class="font-bold mt-3 text-[15px] leading-tight">{{ $scholarship->title }}</h3>
                        <p class="text-xs text-gray-500 mt-2">{{ \Illuminate\Support\Str::limit($scholarship->description, 60) }}</p>
                        <a href="{{ route('scholarships.show', $scholarship->id) }}" class="mt-4 block text-center bg-purple-600 text-white py-2.5 rounded-xl text-xs font-bold">View Details</a>
                    </div>
                @empty
                    <p class="col-span-4 text-gray-500">No scholarships found.</p>
                @endforelse
            </div>
        </div>
    </main>
</body>
</html>