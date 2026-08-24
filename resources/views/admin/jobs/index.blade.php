@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">All Govt Jobs ({{ $jobs->count() }})</h1>
        <a href="{{ route('admin.jobs.create') }}" class="bg-black text-white px-4 py-2 rounded-xl font-bold text-sm">+ Add Job</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white border rounded-2xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b font-bold">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 font-bold">{{ $job->title }}</td>
                    <td class="p-4 flex gap-2">
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg text-xs">Edit</a>
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded-lg text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection