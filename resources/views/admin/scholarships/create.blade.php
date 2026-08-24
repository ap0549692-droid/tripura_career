@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
<h1 class="text-xl font-bold mb-4">Add New Scholarship</h1>
<form action="{{ route('admin.scholarships.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="text" name="title" placeholder="Scholarship Title" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="provider" placeholder="Provider (e.g. Tripura Govt)" class="w-full border p-3 rounded mb-3" required>
<input type="date" name="last_date" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="apply_link" placeholder="Apply Link https://" class="w-full border p-3 rounded mb-3" required>
<textarea name="description" placeholder="Description" class="w-full border p-3 rounded mb-3" rows="4"></textarea>
<input type="file" name="image" class="w-full border p-2 rounded mb-4">
<button class="w-full bg-blue-600 text-white py-3 rounded-full font-bold">Save Scholarship</button>
</form>
</div>
@endsection