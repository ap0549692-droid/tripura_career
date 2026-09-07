@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-10">

    <a href="{{ route('admitCards.index') }}"
       class="inline-block mb-6 text-blue-600 font-bold">
        ← Back to Admit Cards
    </a>


    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 md:p-8">

        <div class="flex items-center gap-3 mb-6">

            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center text-2xl">
                📄
            </div>

            <div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-900">
                    {{ $admitCard->title }}
                </h1>

                <p class="text-gray-500 text-sm">
                    Admit Card
                </p>
            </div>

        </div>


        @if(!empty($admitCard->description))

            <div class="bg-gray-50 rounded-xl p-5 mb-6">

                <h2 class="font-bold text-lg mb-2">
                    Description
                </h2>

                <p class="text-gray-600 leading-7">
                    {{ $admitCard->description }}
                </p>

            </div>

        @endif


        @if($admitCard->link)

            <a href="{{ $admitCard->link }}"
               target="_blank"
               rel="noopener noreferrer"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                      text-white px-6 py-3 rounded-xl font-bold shadow">

                📥 Download Admit Card

            </a>

        @else

            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-xl">
                ⚠️ Admit Card link abhi available nahi hai.
            </div>

        @endif

    </div>

</div>

@endsection