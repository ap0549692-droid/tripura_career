@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow mt-6">
    <h2 class="text-2xl font-bold mb-6">Add New Scholarship</h2>
    
    <form method="POST" action="{{ route('admin.scholarships.store') }}" class="space-y-4">
        @csrf
        
        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input name="title" class="w-full border p-2 rounded" placeholder="e.g. SC Post Matric" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Provider</label>
            <input name="provider" class="w-full border p-2 rounded" placeholder="NSP">
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="3" placeholder="Scholarship details" required></textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Amount</label>
                <input name="amount" type="number" class="w-full border p-2 rounded" placeholder="5000" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Category</label>
                <select name="category" class="w-full border p-2 rounded" required>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="OBC">OBC</option>
                    <option value="General">General</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Last Date</label>
            <input name="last_date" type="date" class="w-full border p-2 rounded" required>
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded font-bold hover:bg-green-700">Add Scholarship</button>
    </form>
</div>
@endsection