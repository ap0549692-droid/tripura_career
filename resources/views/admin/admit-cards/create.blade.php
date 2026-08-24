@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Add Admit Card</h1>
    <form action="{{route('admin.admit-cards.store')}}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        <input type="text" name="title" placeholder="Exam Title" class="w-full border p-2 rounded" required>
        <input type="text" name="department" placeholder="Department e.g. TPSC" class="w-full border p-2 rounded" required>
        <input type="text" name="exam_date" placeholder="Exam Date" class="w-full border p-2 rounded">
        <input type="url" name="admit_link" placeholder="Download Link" class="w-full border p-2 rounded" required>
        <textarea name="description" placeholder="Description" class="w-full border p-2 rounded" rows="3"></textarea>
        <button class="bg-black text-white px-6 py-2 rounded">Save</button>
    </form>
</div>
@endsection