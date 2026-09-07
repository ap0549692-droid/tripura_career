<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Tripura Career</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-slate-100 text-slate-800">
<div class="flex min-h-screen">
    <aside class="w-64 bg-[#020617] text-white fixed left-0 top-0 bottom-0 z-50 hidden md:flex flex-col">
        <div class="px-6 py-7 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-shield-halved text-xl"></i>
                </div>
                <div>
                    <h1 class="font-bold text-lg">Tripura Admin</h1>
                    <p class="text-xs text-slate-400">Management Panel</p>
                </div>
            </div>
        </div>
        <div class="flex-1 px-4 py-6 overflow-y-auto">
            <p class="text-[11px] uppercase tracking-wider text-slate-500 px-3 mb-3">Main Menu</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white mb-2">
                <i class="fa-solid fa-gauge"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('admin.jobs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition mb-1">
                <i class="fa-solid fa-briefcase w-5"></i><span>Jobs</span>
            </a>
            <a href="{{ route('admin.scholarships.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition mb-1">
                <i class="fa-solid fa-graduation-cap w-5"></i><span>Scholarships</span>
            </a>
            <a href="{{ route('admin.admitCards.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <i class="fa-solid fa-id-card w-5"></i><span>Admit Cards</span>
            </a>
            <p class="text-[11px] uppercase tracking-wider text-slate-500 px-3 mt-8 mb-3">Quick Actions</p>
            <a href="{{ route('admin.jobs.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition mb-1">
                <i class="fa-solid fa-plus w-5"></i><span>Add Job</span>
            </a>
            <a href="{{ route('admin.scholarships.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition mb-1">
                <i class="fa-solid fa-plus w-5"></i><span>Add Scholarship</span>
            </a>
            <a href="{{ route('admin.admitCards.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <i class="fa-solid fa-plus w-5"></i><span>Add Admit Card</span>
            </a>
            <p class="text-[11px] uppercase tracking-wider text-slate-500 px-3 mt-8 mb-3">Website</p>
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <i class="fa-solid fa-globe w-5"></i><span>View Website</span><i class="fa-solid fa-arrow-up-right-from-square text-xs ml-auto"></i>
            </a>
        </div>
        <div class="border-t border-slate-800 p-4">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-semibold text-sm truncate">{{ auth()->user()->name?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email?? 'admin@tripura.com' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white py-3 rounded-xl transition">
                    <i class="fa-solid fa-right-from-bracket"></i>Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="md:ml-64 w-full min-h-screen">
        <header class="bg-white border-b border-slate-200 px-6 md:px-8 py-5">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">Admin Dashboard</h2>
                    <p class="text-sm text-slate-500 mt-1">Manage your Tripura Jobs & Scholarships portal</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-2 border border-slate-200 px-4 py-2.5 rounded-xl hover:bg-slate-50">
                        <i class="fa-solid fa-globe"></i>Website
                    </a>
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-5 md:p-8">
            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-xl mb-6">
                ✅ {{ session('success') }}
            </div>
            @endif

            {{-- Welcome Banner WITH 3 BUTTONS --}}
            <section class="rounded-2xl p-7 md:p-8 mb-7 bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 mb-2">Welcome back,</p>
                        <h1 class="text-3xl md:text-4xl font-bold">{{ auth()->user()->name?? 'Admin' }} 👋</h1>
                        <p class="mt-2 text-blue-100">Here's what's happening on your portal today.</p>
                        {{-- 3 FETCH BUTTONS --}}
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('admin.autofetch') }}" class="bg-white text-blue-600 px-5 py-3 rounded-xl font-bold hover:bg-orange-100 transition shadow">
                                🔄 Fetch Jobs
                            </a>
                            <a href="{{ route('admin.autofetch.scholarship') }}" class="bg-white text-purple-600 px-5 py-3 rounded-xl font-bold hover:bg-purple-100 transition shadow">
                                🎓 Fetch Scholarships
                            </a>
                            <a href="{{ route('admin.autofetch.admitcard') }}" class="bg-white text-emerald-600 px-5 py-3 rounded-xl font-bold hover:bg-emerald-100 transition shadow">
                                🎫 Fetch Admit Cards
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:flex w-16 h-16 rounded-2xl bg-white/15 items-center justify-center">
                        <i class="fa-solid fa-chart-line text-3xl"></i>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Total Jobs</p>
                            <h3 class="text-4xl font-bold text-slate-900 mt-3">{{ $jobCount }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.jobs.index') }}" class="inline-block mt-6 text-sm font-semibold text-blue-600">Manage Jobs →</a>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Total Scholarships</p>
                            <h3 class="text-4xl font-bold text-slate-900 mt-3">{{ $scholarshipCount }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                            <i class="fa-solid fa-graduation-cap text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.scholarships.index') }}" class="inline-block mt-6 text-sm font-semibold text-purple-600">Manage Scholarships →</a>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Total Admit Cards</p>
                            <h3 class="text-4xl font-bold text-slate-900 mt-3">{{ $admitCardCount }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-id-card text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.admitCards.index') }}" class="inline-block mt-6 text-sm font-semibold text-emerald-600">Manage Admit Cards →</a>
                </div>
            </div>

            <h2 class="text-lg font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <a href="{{ route('admin.jobs.create') }}" class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4 hover:shadow-md hover:-translate-y-0.5 transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center"><i class="fa-solid fa-plus text-xl"></i></div>
                    <div><h3 class="font-bold">Add New Job</h3><p class="text-sm text-slate-500">Publish a new job</p></div>
                </a>
                <a href="{{ route('admin.scholarships.create') }}" class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4 hover:shadow-md hover:-translate-y-0.5 transition">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center"><i class="fa-solid fa-graduation-cap"></i></div>
                    <div><h3 class="font-bold">Add Scholarship</h3><p class="text-sm text-slate-500">Publish scholarship</p></div>
                </a>
                <a href="{{ route('admin.admitCards.create') }}" class="bg-white border border-slate-200 rounded-2xl p-5 flex items-center gap-4 hover:shadow-md hover:-translate-y-0.5 transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center"><i class="fa-solid fa-id-card"></i></div>
                    <div><h3 class="font-bold">Add Admit Card</h3><p class="text-sm text-slate-500">Publish admit card</p></div>
                </a>
            </div>

            <section class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
                    <div><h2 class="font-bold text-lg">Recent Jobs</h2><p class="text-sm text-slate-500">Latest jobs added to the portal</p></div>
                    <a href="{{ route('admin.jobs.index') }}" class="text-sm font-semibold text-blue-600">View All</a>
                </div>
                @if($recentJobs->count() > 0)
                    <div class="divide-y divide-slate-100">
                        @foreach($recentJobs as $job)
                            <div class="px-6 py-5 flex items-center justify-between gap-4 hover:bg-slate-50">
                                <div class="min-w-0"><h3 class="font-semibold truncate">{{ $job->title }}</h3><p class="text-sm text-slate-500 mt-1">{{ $job->department?? 'Government Department' }}</p></div>
                                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-blue-600 text-sm font-semibold">Edit</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-16 text-center">
                        <div class="w-16 h-16 rounded-2xl bg-slate-100 mx-auto mb-4 flex items-center justify-center"><i class="fa-solid fa-briefcase text-2xl text-slate-400"></i></div>
                        <h3 class="font-semibold text-slate-700">No jobs found.</h3>
                        <p class="text-sm text-slate-400 mt-1">Add your first job from Quick Actions.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>
</div>
</body>
</html>