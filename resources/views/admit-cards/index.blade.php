@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-black text-gray-900">
            📄 Admit Cards
        </h1>

        <p class="text-gray-500 mt-2">
            Latest Government Exam Admit Cards
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6">
            ✅ {{ session('success') }}
        </div>
    @endif


    {{-- Admit Cards --}}
    @forelse($admitCards as $admitCard)

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-5 mb-4
                    hover:shadow-xl transition">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ $admitCard->title }}
                    </h2>

                    @if(!empty($admitCard->description))
                        <p class="text-gray-500 text-sm mt-2">
                            {{ $admitCard->description }}
                        </p>
                    @endif
                </div>


                <div class="flex gap-2">

                    <a href="{{ route('admitCards.show', $admitCard->id) }}"
                       class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg font-bold">
                        View
                    </a>

                    @if($admitCard->link)
                        <a href="{{ $admitCard->link }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold">
                            Download
                        </a>
                    @endif

                </div>

            </div>

        </div>

    @empty

        <div class="bg-white rounded-2xl shadow p-10 text-center">

            <div class="text-5xl mb-4">
                📄
            </div>

            <h2 class="text-xl font-bold text-gray-800">
                No Admit Cards Available
            </h2>

            <p class="text-gray-500 mt-2">
                Abhi koi admit card available nahi hai.
            </p>

        </div>

    @endforelse

</div>

@endsection