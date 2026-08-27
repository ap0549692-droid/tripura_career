@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

    @if(session('success'))
        <div class="bg-green-600 text-white px-4 py-3 rounded-xl mb-4 font-bold shadow">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white px-4 py-3 rounded-xl mb-4 font-bold shadow">❌ {{ session('error') }}</div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }} 👋</h1>
        <p class="text-gray-600">Email: {{ Auth::user()->email }}</p>
        <div class="mt-2 bg-green-100 text-green-700 px-3 py-1 rounded inline-block text-sm font-bold">✅ You are logged in!</div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-xl shadow border-l-4 border-green-600">
            <h2 class="font-bold text-lg">Govt Jobs</h2>
            <p class="text-3xl font-extrabold mt-2">{{ \App\Models\Job::count() }}</p>
            <a href="/admin/jobs" class="mt-3 inline-block bg-green-600 text-white px-4 py-1.5 rounded">Manage Jobs</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow border-l-4 border-blue-600">
            <h2 class="font-bold text-lg">Scholarships</h2>
            <p class="text-3xl font-extrabold mt-2">{{ \App\Models\Scholarship::count() }}</p>
            <a href="/admin/scholarships" class="mt-3 inline-block bg-blue-600 text-white px-4 py-1.5 rounded">Manage Scholarships</a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow border-l-4 border-purple-600">
            <h2 class="font-bold text-lg">Quick Actions</h2>
            <div class="mt-3 flex flex-col gap-2">
                <a href="/admin/jobs/create" class="bg-gray-800 text-white px-4 py-1.5 rounded text-center">+ Add New Job</a>
                <a href="/admin/admit-cards" class="bg-white p-3 rounded-xl shadow border border-blue-200 text-center hover:bg-blue-50">
                    <h3 class="font-bold">Admit Cards</h3>
                    <p class="text-xs text-gray-500">Manage All Admit Cards</p>
                </a>
                <a href="/admin/scholarships/create" class="bg-gray-800 text-white px-4 py-1.5 rounded text-center">+ Add Scholarship</a>
                <a href="/" class="bg-gray-200 px-4 py-1.5 rounded text-center">View Website</a>
            </div>
        </div>
    </div>

    <!-- GOOGLE AUTO-FETCH SYSTEM - NEW ADDED -->
    <div class="mt-6 bg-white p-6 rounded-xl shadow">
        <h2 class="font-black text-lg mb-4">🚀 Google Auto-Fetch System (Automatic)</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <form method="POST" action="{{ route('admin.fetchJobs') }}">@csrf
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2.5 rounded-xl font-bold shadow text-sm">Fetch Jobs</button>
            </form>
            <form method="POST" action="{{ route('admin.fetchScholarships') }}">@csrf
                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white px-3 py-2.5 rounded-xl font-bold shadow text-sm">Fetch Scholarships</button>
            </form>
            <form method="POST" action="{{ route('admin.fetchAdmitCards') }}">@csrf
                <button class="w-full bg-orange-500 hover:bg-orange-600 text-white px-3 py-2.5 rounded-xl font-bold shadow text-sm">Auto-Link Admit</button>
            </form>
            <form method="POST" action="{{ route('admin.fetchResults') }}">@csrf
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2.5 rounded-xl font-bold shadow text-sm">Auto-Link Result</button>
            </form>
        </div>
        <p class="text-[11px] text-gray-400 mt-3">* When user applies for a job, and Google News releases its admit card, system will auto-link it. User will see Download button in My Applications.</p>
        <div class="mt-3 bg-green-50 border border-green-200 p-2 rounded-xl text-xs font-bold text-green-700">Auto-Fetch: Every 6 Hours | Next: {{ now()->addHours(6)->format('h:i A') }}</div>
    </div>

    <!-- Logout -->
    <div class="mt-6 bg-white p-4 rounded-xl shadow flex justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-600 text-white px-5 py-2 rounded font-bold">Logout</button>
        </form>
        <span class="text-sm text-gray-500">Admin Panel Ready ✅</span>
    </div>

</div>
@endsection