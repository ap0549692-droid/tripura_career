@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">

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
                                <a href="/admin/admit-cards" class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-600">
    <h3 class="font-bold">Admit Cards</h3>
    <p class="text-xs text-gray-500">Manage All Admit Cards</p>
</a>
                <a href="/admin/scholarships/create" class="bg-gray-800 text-white px-4 py-1.5 rounded text-center">+ Add Scholarship</a>
                <a href="/" class="bg-gray-200 px-4 py-1.5 rounded text-center">View Website</a>
            </div>
        </div>
    </div>

    <!-- Eye button + Logout -->
    <div class="mt-6 bg-white p-4 rounded-xl shadow flex justify-between">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-600 text-white px-5 py-2 rounded font-bold">Logout</button>
        </form>
        <span class="text-sm text-gray-500">Admin Panel Ready ✅</span>
    </div>

</div>
@endsection