@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Add New Scholarship</h1>

    <form method="POST" action="{{ route('admin.scholarships.store') }}" class="bg-white p-6 rounded-xl shadow space-y-4">
        @csrf
        
        <div>
            <label class="font-bold">Title</label>
            <input type="text" name="title" class="w-full border p-3 rounded-lg" placeholder="e.g. Post Matric Scholarship" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold">Provider</label>
                <input type="text" name="provider" class="w-full border p-3 rounded-lg" placeholder="e.g. Tripura Govt" required>
            </div>
            <div>
                <label class="font-bold">Category</label>
                <select name="category" class="w-full border p-3 rounded-lg" required>
                    <option value="Post Matric">Post Matric</option>
                    <option value="Merit">Merit</option>
                    <option value="Girls">Girls</option>
                    <option value="Central">Central</option>
                    <option value="SC/ST">SC/ST</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold">Amount (₹)</label>
                <input type="text" name="amount" class="w-full border p-3 rounded-lg" placeholder="15000" required>
            </div>
            <div>
                <label class="font-bold">Last Date</label>
                <input type="date" name="last_date" class="w-full border p-3 rounded-lg" required>
            </div>
        </div>

        <div>
            <label class="font-bold">Official Apply Link (Most Important)</label>
            <input type="url" name="apply_link" class="w-full border p-3 rounded-lg" placeholder="https://scholarships.gov.in" required>
        </div>

        <div>
            <label class="font-bold">Description</label>
            <textarea name="description" rows="4" class="w-full border p-3 rounded-lg" placeholder="Full details..." required></textarea>
        </div>

        <button class="bg-gray-900 text-white px-8 py-3 rounded-full font-bold w-full">Save Scholarship</button>
    </form>
</div>
@endsection