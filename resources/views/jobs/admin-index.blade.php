@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">
<h2 class="text-2xl font-bold mb-4">Admin - Manage Jobs</h2>
<a href="/admin/jobs/create" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Add New Job</a>
<table class="w-full border mt-4">
<tr class="bg-gray-100"><th class="p-2 border">Title</th><th class="p-2 border">Last Date</th><th class="p-2 border">Action</th></tr>
@foreach($jobs as $job)
<tr>
<td class="p-2 border">{{ $job->title }}</td>
<td class="p-2 border">{{ $job->last_date }}</td>
<td class="p-2 border">
<form method="POST" action="/admin/jobs/{{ $job->id }}" onsubmit="return confirm('Delete?')">
@csrf @method('DELETE')
<button class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
@endsection