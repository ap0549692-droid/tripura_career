@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Admit Card</h1>
    <form action="{{route('admin.admit-cards.update',$card->id)}}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf @method('PUT')
        <input type="text" name="title" value="{{$card->title}}" class="w-full border p-2 rounded" required>
        <input type="text" name="department" value="{{$card->department}}" class="w-full border p-2 rounded" required>
        <input type="text" name="exam_date" value="{{$card->exam_date}}" class="w-full border p-2 rounded">
        <input type="url" name="admit_link" value="{{$card->admit_link}}" class="w-full border p-2 rounded" required>
        <textarea name="description" class="w-full border p-2 rounded" rows="3">{{$card->description}}</textarea>
        <button class="bg-black text-white px-6 py-2 rounded">Update</button>
    </form>
</div>
@endsection