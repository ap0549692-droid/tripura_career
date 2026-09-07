@extends('layouts.app')

@section('title', 'Dashboard - Tripura Career')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- HEADER --}}
    <div class="glass-card rounded-3xl p-8 shadow-lg">
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-5">
            <div>
                <p class="text-orange-600 font-bold">TRIPURA CAREER</p>
                <h1 class="text-3xl font-extrabold mt-1">Welcome, {{ Auth::user()->name }} 👋</h1>
                <p class="text-gray-500 mt-2">{{ Auth::user()->email }}</p>
            </div>
            <div>
                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">✓ Logged In</span>
            </div>
        </div>
    </div>

    {{-- CARDS --}}
    <div class="grid md:grid-cols-3 gap-5 mt-6">
        <a href="{{ route('jobs.index') }}" class="bg-white rounded-2xl p-6 shadow hover:shadow-xl transition">
            <div class="text-3xl">💼</div>
            <h2 class="font-extrabold text-xl mt-3">Govt Jobs</h2>
            <p class="text-gray-500 text-sm mt-2">Find latest Tripura Government Jobs.</p>
        </a>
        <a href="{{ route('scholarships.index') }}" class="bg-white rounded-2xl p-6 shadow hover:shadow-xl transition">
            <div class="text-3xl">🎓</div>
            <h2 class="font-extrabold text-xl mt-3">Scholarships</h2>
            <p class="text-gray-500 text-sm mt-2">Check latest scholarships.</p>
        </a>
        <a href="{{ route('admitCards.index') }}" class="bg-white rounded-2xl p-6 shadow hover:shadow-xl transition">
            <div class="text-3xl">📄</div>
            <h2 class="font-extrabold text-xl mt-3">Admit Cards</h2>
            <p class="text-gray-500 text-sm mt-2">Find available admit cards.</p>
        </a>
    </div>

    {{-- LOGOUT --}}
    <div class="mt-8">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold px-6 py-3 rounded-xl transition">
                Logout
            </button>
        </form>
    </div>

</div>
@endsection