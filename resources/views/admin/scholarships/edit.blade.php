@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-6">
<h1 class="text-xl font-bold mb-4">Edit Scholarship</h1>
<form action="/admin/scholarships/{{$scholarship->id}}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<input type="text" name="title" value="{{$scholarship->title}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="provider" value="{{$scholarship->provider}}" class="w-full border p-3 rounded mb-3" required>
<input type="date" name="last_date" value="{{$scholarship->last_date}}" class="w-full border p-3 rounded mb-3" required>
<input type="text" name="apply_link" value="{{$scholarship->apply_link}}" class="w-full border p-3 rounded mb-3" required>
<textarea name="description" class="w-full border p-3 rounded mb-3" rows="4">{{$scholarship->description}}</textarea>
<input type="file" name="image" class="w-full border p-2 rounded mb-4">
<button class="w-full bg-black text-white py-3 rounded-full font-bold">Update Scholarship</button>
</form>
</div>
@endsection