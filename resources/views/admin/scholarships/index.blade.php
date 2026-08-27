@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">All Scholarships ({{ $scholarships->total() ?? $scholarships->count() }})</h1>
        <a href="{{ route('admin.scholarships.create') }}" class="bg-black text-white px-4 py-2 rounded-xl font-bold text-sm">+ Add Scholarship</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.scholarships.index') }}" class="px-4 py-2 rounded-xl font-bold text-sm border {{ !request('filter') ? 'bg-black text-white' : 'bg-white' }}">All</a>
        <a href="?filter=tripura" class="px-4 py-2 rounded-xl font-bold text-sm border {{ request('filter')=='tripura' ? 'bg-green-600 text-white' : 'bg-white text-green-700 border-green-200' }}">✅ Tripura Only</a>
        <a href="?filter=garbage" class="px-4 py-2 rounded-xl font-bold text-sm border {{ request('filter')=='garbage' ? 'bg-red-600 text-white' : 'bg-white text-red-600 border-red-200' }}">🗑️ Garbage</a>
    </div>

    <div class="flex flex-wrap gap-3 justify-between items-center mb-4">
        <form method="GET" class="flex gap-2">
            @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border px-4 py-2 rounded-xl text-sm w-64">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold text-sm">Filter</button>
        </form>

        @if(request('filter') == 'garbage')
        <form method="POST" action="{{ route('admin.scholarships.bulkDelete') }}" onsubmit="return confirm('Delete all garbage scholarships?')">
            @csrf
            <button class="bg-red-700 text-white px-4 py-2 rounded-xl font-bold text-sm">🔥 Delete All Garbage</button>
        </form>
        @endif
    </div>

    <div class="bg-white border rounded-2xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b font-bold"><tr><th class="p-4">Title</th><th class="p-4">Action</th></tr></thead>
            <tbody>
                @forelse($scholarships as $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold">{{ $s->title }}</td>
                    <td class="p-4 flex gap-2">
                        <a href="{{ route('admin.scholarships.edit', $s->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">Edit</a>
                        <form action="{{ route('admin.scholarships.destroy', $s->id) }}" method="POST">@csrf @method('DELETE')<button class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs">Delete</button></form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="2" class="p-6 text-center">No data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $scholarships->appends(request()->query())->links() }}</div>
</div>
@endsection