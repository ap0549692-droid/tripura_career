@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
<h1 class="text-xl font-bold mb-4">Edit Job</h1>
<form action="/admin/jobs/{{$job->id}}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<input type="text" name="title" value="{{$job->title}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="department" value="{{$job->department}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="location" value="{{$job->location}}" class="w-full border p-3 rounded mb-3" required>
<input type="date" name="last_date" value="{{$job->last_date}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="apply_link" value="{{$job->apply_link}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="notification_link" value="{{$job->notification_link ?? ''}}" class="w-full border p-3 rounded mb-3">
<textarea name="description" class="w-full border p-3 rounded mb-3" rows="4">{{$job->description}}</textarea>
<input type="file" name="image" class="w-full border p-2 rounded mb-4">
<button class="w-full bg-black text-white py-3 rounded-full font-bold">Update Job</button>
</form>
</div>
@endsection