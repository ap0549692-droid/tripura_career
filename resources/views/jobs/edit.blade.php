@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow mt-6">
<h1 class="text-2xl font-bold mb-4">Edit Job</h1>
<form method="POST" action="{{ route('admin.jobs.update', $job->id) }}">
@csrf @method('PUT')
<label class="block mb-2">Title</label>
<input name="title" value="{{ $job->title }}" class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Department</label>
<input name="department" value="{{ $job->department }}" class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Qualification</label>
<input name="qualification" value="{{ $job->qualification }}" class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Last Date</label>
<input type="date" name="last_date" value="{{ $job->last_date }}" class="w-full border p-2 rounded mb-3">

<label class="block mb-2">Apply Link</label>
<input name="apply_link" value="{{ $job->apply_link }}" class="w-full border p-2 rounded mb-3">

<label class="font-bold text-sm text-blue-600">Official Apply Link</label>
<input type="url" name="apply_link" value="{{ $job->apply_link ?? '' }}" class="w-full border-2 border-blue-200 p-3 rounded-lg" placeholder="https://tripura.gov.in/job" required>

<button class="bg-blue-600 text-white px-6 py-2 rounded">Update</button>
</form>
</div>
@endsection