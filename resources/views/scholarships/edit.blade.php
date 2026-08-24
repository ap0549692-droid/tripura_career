@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Edit Scholarship</h1>

        <form method="POST" action="{{ route('admin.scholarships.update', $scholarship->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="font-bold text-sm">Title</label>
                <input type="text" name="title" value="{{ $scholarship->title }}" class="w-full border p-3 rounded-lg" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-bold text-sm">Provider</label>
                    <input type="text" name="provider" value="{{ $scholarship->provider }}" class="w-full border p-3 rounded-lg" required>
                </div>
                <div>
                    <label class="font-bold text-sm">Category</label>
                    <select name="category" class="w-full border p-3 rounded-lg" required>
                        <option value="Post Matric" {{ $scholarship->category=='Post Matric'?'selected':'' }}>Post Matric</option>
                        <option value="Merit" {{ $scholarship->category=='Merit'?'selected':'' }}>Merit</option>
                        <option value="Girls" {{ $scholarship->category=='Girls'?'selected':'' }}>Girls</option>
                        <option value="Central" {{ $scholarship->category=='Central'?'selected':'' }}>Central</option>
                        <option value="SC/ST" {{ $scholarship->category=='SC/ST'?'selected':'' }}>SC/ST</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="font-bold text-sm">Description</label>
                <textarea name="description" rows="4" class="w-full border p-3 rounded-lg" required>{{ $scholarship->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-bold text-sm">Amount</label>
                    <input type="text" name="amount" value="{{ $scholarship->amount }}" class="w-full border p-3 rounded-lg" required>
                </div>
                <div>
                    <label class="font-bold text-sm">Deadline</label>
                    <input type="date" name="last_date" value="{{ \Carbon\Carbon::parse($scholarship->last_date ?? $scholarship->deadline)->format('Y-m-d') }}" class="w-full border p-3 rounded-lg" required>
                </div>
            </div>

            <div>
                <label class="font-bold text-sm text-blue-600">Official Apply Link (IMPORTANT)</label>
                <input type="url" name="apply_link" value="{{ $scholarship->apply_link ?? 'https://scholarships.gov.in' }}" class="w-full border-2 border-blue-200 p-3 rounded-lg" placeholder="https://scholarships.gov.in" required>
            </div>

            <div class="flex gap-3 pt-2">
                <button class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold">Update</button>
                <a href="{{ route('admin.scholarships.index') }}" class="bg-gray-100 px-8 py-2.5 rounded-lg font-bold">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection