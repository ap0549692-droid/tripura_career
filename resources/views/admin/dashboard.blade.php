<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - TripuraCareer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-[#f5f7fb]">
<div class="max-w-7xl mx-auto p-6">
  @if(session('success'))
    <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-6 shadow flex items-center gap-2"><i class="fa-solid fa-check"></i> {{ session('success') }}</div>
  @endif

  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-extrabold">TripuraCareer <span class="text-blue-600">Admin</span></h1>
    <a href="/" class="bg-white px-5 py-2 rounded-full shadow font-bold"><i class="fa-solid fa-eye mr-2"></i>View Website</a>
  </div>
  
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-600 to-blue-400 p-6 rounded-2xl shadow-lg text-white">
      <div class="flex justify-between"><p class="opacity-80">Total Govt Jobs</p><i class="fa-solid fa-briefcase text-2xl opacity-50"></i></div>
      <h2 class="text-4xl font-black mt-2">{{ $totalJobs }}</h2>
      <p class="text-sm mt-2 opacity-80">+5 this week</p>
    </div>
    <div class="bg-gradient-to-br from-purple-600 to-pink-500 p-6 rounded-2xl shadow-lg text-white">
      <div class="flex justify-between"><p class="opacity-80">Total Scholarships</p><i class="fa-solid fa-graduation-cap text-2xl opacity-50"></i></div>
      <h2 class="text-4xl font-black mt-2">{{ $totalScholarships }}</h2>
      <p class="text-sm mt-2 opacity-80">All with different links</p>
    </div>
    <div class="bg-gradient-to-br from-emerald-500 to-green-400 p-6 rounded-2xl shadow-lg text-white">
      <div class="flex justify-between"><p class="opacity-80">Applications</p><i class="fa-solid fa-users text-2xl opacity-50"></i></div>
      <h2 class="text-4xl font-black mt-2">{{ $totalApplications }}</h2>
      <p class="text-sm mt-2 opacity-80">Students applied</p>
    </div>
  </div>

  <div class="bg-white p-5 rounded-2xl shadow mb-8 flex flex-wrap gap-4">
    <form method="POST" action="{{ route('admin.fetchJobs') }}">@csrf
      <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold shadow"><i class="fa-solid fa-rotate mr-2"></i>Fetch TPSC Jobs</button>
    </form>
    <form method="POST" action="{{ route('admin.fetchScholarships') }}">@csrf
      <button class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-bold shadow"><i class="fa-solid fa-wand-magic-sparkles mr-2"></i>Fetch Scholarships</button>
    </form>
    <a href="{{ route('admin.jobs.index') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold">Manage Jobs</a>
    <a href="{{ route('admin.scholarships.index') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold">Manage Scholarships</a>
    <a href="{{ route('admin.applications.index') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold">Applications</a>
    <span class="ml-auto bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm font-bold"><i class="fa-solid fa-clock mr-1"></i>Auto-Fetch: Daily 8 AM</span>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-5 rounded-2xl shadow">
      <h3 class="font-bold mb-4 text-lg"><i class="fa-solid fa-briefcase mr-2 text-blue-600"></i>Recent Jobs</h3>
      @forelse($recentJobs as $job)<div class="border-b py-3 text-sm hover:bg-gray-50"><b>{{ Str::limit($job->title, 70) }}</b><br><span class="text-gray-400 text-xs">{{ $job->created_at->diffForHumans() }}</span></div>@empty <p class="text-gray-400">No jobs</p> @endforelse
    </div>
    <div class="bg-white p-5 rounded-2xl shadow">
      <h3 class="font-bold mb-4 text-lg"><i class="fa-solid fa-graduation-cap mr-2 text-purple-600"></i>Recent Scholarships</h3>
      @forelse($recentScholarships as $s)<div class="border-b py-3 text-sm hover:bg-gray-50"><b>{{ $s->title }}</b><br><span class="text-green-600 text-xs font-bold">{{ $s->amount }}</span></div>@empty <p class="text-gray-400">No scholarships</p> @endforelse
    </div>
  </div>
</div>
</body>
</html>