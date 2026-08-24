@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-1">Manage Scholarships - ADMIN</h1>
  <p class="text-sm text-gray-500 mb-4">Edit/Delete yaha ayega</p>
  @if(session('success'))<div class="bg-green-100 p-3 mb-4">{{session('success')}}</div>@endif
  <a href="{{route('admin.scholarships.create')}}" class="bg-black text-white px-4 py-2 rounded-full text-sm mb-6 inline-block">+ Add New</a>
  @foreach($scholarships as $s)
  <div class="bg-white p-4 mb-3 rounded-xl shadow flex justify-between items-center border-l-4 border-blue-500">
    <div><b>{{$s->title}}</b><br><span class="text-xs">{{$s->provider}} | {{$s->last_date}}</span></div>
    <div class="flex gap-2">
      <a href="/admin/scholarships/{{$s->id}}/edit" class="bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-bold">Edit</a>
      <form action="/admin/scholarships/{{$s->id}}" method="POST" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="bg-red-600 text-white px-4 py-1 rounded-full text-xs font-bold">Delete</button></form>
    </div>
  </div>
  @endforeach
</div>
@endsection