@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-black">All Admit Cards ({{ $admitCards->count() }})</h1>
        <a href="/admin/admit-cards/create" class="bg-black text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-gray-800">+ Add Admit Card</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-xl mb-4 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <div class="bg-white border rounded-2xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b font-black text-[12px] tracking-widest text-gray-600">
                <tr>
                    <th class="p-4">Title</th>
                    <th class="p-4">Department</th>
                    <th class="p-4">Exam Date</th>
                    <th class="p-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admitCards as $card)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-4">
                        <p class="font-bold text-[14px]">{{ $card->title }}</p>
                        <a href="{{ $card->admit_link }}" target="_blank" class="text-[11px] text-green-600 font-bold truncate">Link: {{ Str::limit($card->admit_link, 40) }}</a>
                    </td>
                    <td class="p-4 font-bold text-xs text-gray-600">{{ $card->department }}</td>
                    <td class="p-4 font-bold text-xs">{{ $card->exam_date }}</td>
                    <td class="p-4 flex gap-2 justify-end">
                        <a href="/admin/admit-cards/{{ $card->id }}/edit" class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold">Edit</a>
                        <form action="/admin/admit-cards/{{ $card->id }}" method="POST" onsubmit="return confirm('Delete kar du?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gray-500 font-bold">No Admit Cards found. Add pe click karke pehla add kar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection