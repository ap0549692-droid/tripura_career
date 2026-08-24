@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
<h1 class="text-xl font-bold mb-4">Add New Govt Job</h1>
<form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="text" name="title" placeholder="Job Title - e.g. Tripura Police Constable" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="department" placeholder="Department" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="location" placeholder="Location - Agartala" class="w-full border p-3 rounded mb-3" value="Tripura">
<input type="date" name="last_date" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="apply_link" placeholder="Apply Link https://" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="notification_link" placeholder="Notification PDF Link" class="w-full border p-3 rounded mb-3">
<textarea name="description" placeholder="Job Description" class="w-full border p-3 rounded mb-3" rows="4"></textarea>
<input type="file" name="image" class="w-full border p-2 rounded mb-4">
<button class="w-full bg-orange-500 text-white py-3 rounded-full font-bold">Save Job</button>
</form>
</div>
@endsection