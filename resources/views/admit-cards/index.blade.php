@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto p-6 pt-20">
    <h1 class="text-3xl font-bold mb-6">Latest Admit Cards</h1>
    @foreach($admitCards as $card)
        <div class="bg-white p-5 rounded-xl shadow mb-4 border-l-4 border-orange-500">
            <h2 class="font-bold text-lg">{{$card->title}}</h2>
            <p class="text-sm text-gray-500">{{$card->department}} | {{$card->exam_date}}</p>
            <a href="{{$card->admit_link}}" target="_blank" class="bg-black text-white px-4 py-1 rounded-full text-sm mt-2 inline-block">Download</a>
        </div>
    @endforeach
</div>
@endsection