@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-black text-gray-900">
                📄 Manage Admit Cards
            </h1>

            <p class="text-gray-500 mt-1">
                Add, edit and delete admit cards.
            </p>
        </div>


        <a href="{{ route('admin.admitCards.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold shadow">
            + Add Admit Card
        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700
                    px-4 py-3 rounded-xl mb-5 font-bold">

            ✅ {{ session('success') }}

        </div>

    @endif


    {{-- Error --}}
    @if(session('error'))

        <div class="bg-red-100 border border-red-300 text-red-700
                    px-4 py-3 rounded-xl mb-5 font-bold">

            ❌ {{ session('error') }}

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="bg-red-100 border border-red-300 text-red-700
                    px-4 py-3 rounded-xl mb-5">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-gray-900 text-white">

                    <tr>

                        <th class="px-5 py-4">
                            #
                        </th>

                        <th class="px-5 py-4">
                            Title
                        </th>

                        <th class="px-5 py-4">
                            Link
                        </th>

                        <th class="px-5 py-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($admitCards as $index => $admitCard)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-5 py-4">
                                {{ $admitCards->firstItem() + $index }}
                            </td>


                            <td class="px-5 py-4">

                                <div class="font-bold text-gray-900">
                                    {{ $admitCard->title }}
                                </div>

                                @if($admitCard->description)

                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ Str::limit($admitCard->description, 80) }}
                                    </div>

                                @endif

                            </td>


                            <td class="px-5 py-4">

                                @if($admitCard->link)

                                    <a href="{{ $admitCard->link }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="text-blue-600 font-bold">

                                        Open Link

                                    </a>

                                @else

                                    <span class="text-gray-400">
                                        No Link
                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4">

                                <div class="flex flex-wrap gap-2">

                                    <a href="{{ route('admin.admitCards.edit', $admitCard->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg font-bold text-sm">
                                        Edit
                                    </a>


                                    <form method="POST"
                                          action="{{ route('admin.admitCards.destroy', $admitCard->id) }}"
                                          onsubmit="return confirm('Delete this Admit Card?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg font-bold text-sm">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="px-5 py-12 text-center text-gray-500">

                                <div class="text-5xl mb-3">
                                    📄
                                </div>

                                <p class="font-bold">
                                    No Admit Cards Found
                                </p>

                                <a href="{{ route('admin.admitCards.create') }}"
                                   class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg">

                                    + Add First Admit Card

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($admitCards->hasPages())

            <div class="p-5">
                {{ $admitCards->links() }}
            </div>

        @endif

    </div>

</div>

@endsection