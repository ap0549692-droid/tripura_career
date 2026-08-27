@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">All Govt Jobs ({{ $jobs->total() ?? $jobs->count() }})</h1>
        <a href="{{ route('admin.jobs.create') }}" class="bg-black text-white px-4 py-2 rounded-xl font-bold text-sm">+ Add Job</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 font-bold text-sm">{{ session('success') }}</div>
    @endif

    {{-- FILTER BUTTONS --}}
    <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 rounded-xl font-bold text-sm border {{ !request('filter') && !request('search') ? 'bg-black text-white' : 'bg-white' }}">All</a>
        <a href="{{ route('admin.jobs.index') }}?filter=tripura" class="px-4 py-2 rounded-xl font-bold text-sm border {{ request('filter')=='tripura' ? 'bg-green-600 text-white' : 'bg-white text-green-700 border-green-200' }}">✅ Tripura Only</a>
        <a href="{{ route('admin.jobs.index') }}?filter=garbage" class="px-4 py-2 rounded-xl font-bold text-sm border {{ request('filter')=='garbage' ? 'bg-red-600 text-white' : 'bg-white text-red-600 border-red-200' }}">🗑️ Garbage / Non-Tripura</a>
    </div>

    {{-- SEARCH + BULK DELETE --}}
    <div class="flex flex-wrap gap-3 justify-between items-center mb-4">
        <form method="GET" action="{{ route('admin.jobs.index') }}" class="flex gap-2">
            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title... ex: Constable" class="border px-4 py-2 rounded-xl text-sm w-64">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold text-sm">Filter</button>
        </form>

        @if(request('filter') == 'garbage')
        <form method="POST" action="{{ route('admin.jobs.bulkDelete') }}" onsubmit="return confirm('Saare Garbage (Non-Tripura) jobs ek sath delete kar du? Ye wapas nahi ayega!')">
            @csrf
            <button class="bg-red-700 text-white px-4 py-2 rounded-xl font-bold text-sm">🔥 Delete All Garbage Jobs</button>
        </form>
        @endif
    </div>

    <div class="bg-white border rounded-2xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b font-bold">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Last Date</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold">{{ $job->title }}</td>
                    <td class="p-4 text-xs">{{ $job->last_date ?? '2026-09-26' }}</td>
                    <td class="p-4 flex gap-2">
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">Edit</a>
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="p-6 text-center text-gray-500">No jobs found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $jobs->appends(request()->query())->links() }}
    </div>
</div>
@endsection