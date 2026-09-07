@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="mb-6">

        <a href="{{ route('admin.admitCards.index') }}"
           class="text-blue-600 font-bold">

            ← Back to Admit Cards

        </a>

    </div>


    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">

        <h1 class="text-3xl font-black text-gray-900 mb-2">
            ✏️ Edit Admit Card
        </h1>

        <p class="text-gray-500 mb-6">
            Admit card ki information update karo.
        </p>


        @if($errors->any())

            <div class="bg-red-100 border border-red-300 text-red-700
                        px-4 py-3 rounded-xl mb-6">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form method="POST"
              action="{{ route('admin.admitCards.update', $admitCard->id) }}">

            @csrf
            @method('PUT')


            {{-- Title --}}
            <div class="mb-5">

                <label class="block font-bold mb-2">
                    Admit Card Title
                </label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $admitCard->title) }}"
                       required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-blue-500 outline-none">

            </div>


            {{-- Link --}}
            <div class="mb-5">

                <label class="block font-bold mb-2">
                    Admit Card Link
                </label>

                <input type="url"
                       name="link"
                       value="{{ old('link', $admitCard->link) }}"
                       required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3
                              focus:ring-2 focus:ring-blue-500 outline-none">

            </div>


            {{-- Description --}}
            <div class="mb-6">

                <label class="block font-bold mb-2">
                    Description
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3
                                 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description', $admitCard->description) }}</textarea>

            </div>


            <div class="flex gap-3">

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white
                               px-6 py-3 rounded-xl font-bold shadow">

                    ✅ Update Admit Card

                </button>


                <a href="{{ route('admin.admitCards.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800
                          px-6 py-3 rounded-xl font-bold">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection