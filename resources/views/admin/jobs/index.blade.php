@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="flex flex-wrap justify-between items-center gap-4 mb-6">

        <div>

            <h1 class="text-2xl font-black">
                📋 All Govt Jobs
                <span class="text-blue-600">
                    ({{ $jobs->total() }})
                </span>
            </h1>

            <p class="text-gray-500 text-sm mt-1">
                Manage government job notifications
            </p>

        </div>


        <div class="flex gap-2">

            <a
                href="{{ route('dashboard') }}"
                class="bg-gray-100 text-gray-800 px-4 py-2 rounded-xl font-bold text-sm"
            >
                ← Dashboard
            </a>


            <a
                href="{{ route('admin.jobs.create') }}"
                class="bg-black text-white px-4 py-2 rounded-xl font-bold text-sm"
            >
                + Add Job
            </a>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div
            class="bg-green-100 border border-green-200 text-green-700
                   p-3 rounded-xl mb-5 font-bold text-sm"
        >
            ✅ {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div
            class="bg-red-100 border border-red-200 text-red-700
                   p-3 rounded-xl mb-5 font-bold text-sm"
        >
            ❌ {{ session('error') }}
        </div>

    @endif


    {{-- =========================================================
         FILTER BUTTONS
    ========================================================== --}}

    <div class="flex flex-wrap gap-2 mb-4">

        {{-- ALL --}}

        <a
            href="{{ route('admin.jobs.index') }}"
            class="px-4 py-2 rounded-xl font-bold text-sm border
            {{ !request('filter') && !request('search')
                ? 'bg-black text-white'
                : 'bg-white text-gray-700' }}"
        >
            📋 All Jobs
        </a>


        {{-- TRIPURA --}}

        <a
            href="{{ route('admin.jobs.index', ['filter' => 'tripura']) }}"
            class="px-4 py-2 rounded-xl font-bold text-sm border
            {{ request('filter') == 'tripura'
                ? 'bg-green-600 text-white border-green-600'
                : 'bg-white text-green-700 border-green-200' }}"
        >
            ✅ Tripura Only
        </a>


        {{-- GARBAGE --}}

        <a
            href="{{ route('admin.jobs.index', ['filter' => 'garbage']) }}"
            class="px-4 py-2 rounded-xl font-bold text-sm border
            {{ request('filter') == 'garbage'
                ? 'bg-red-600 text-white border-red-600'
                : 'bg-white text-red-600 border-red-200' }}"
        >
            🗑️ Garbage / Non-Tripura
        </a>

    </div>


    {{-- =========================================================
         SEARCH + BULK DELETE
    ========================================================== --}}

    <div class="flex flex-wrap gap-3 justify-between items-center mb-5">


        {{-- SEARCH --}}

        <form
            method="GET"
            action="{{ route('admin.jobs.index') }}"
            class="flex flex-wrap gap-2"
        >

            {{-- Keep current filter --}}

            @if(request('filter'))

                <input
                    type="hidden"
                    name="filter"
                    value="{{ request('filter') }}"
                >

            @endif


            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="🔍 Search title, department..."
                class="border border-gray-300 px-4 py-2 rounded-xl
                       text-sm w-72 outline-none
                       focus:ring-2 focus:ring-blue-500"
            >


            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700
                       text-white px-5 py-2 rounded-xl
                       font-bold text-sm"
            >
                Search
            </button>


            {{-- Clear --}}

            @if(request('search'))

                <a
                    href="{{ request('filter')
                        ? route('admin.jobs.index', ['filter' => request('filter')])
                        : route('admin.jobs.index') }}"
                    class="bg-gray-100 text-gray-700
                           px-4 py-2 rounded-xl font-bold text-sm"
                >
                    Clear
                </a>

            @endif

        </form>


        {{-- BULK DELETE --}}

        @if(request('filter') == 'garbage')

            <form
                method="POST"
                action="{{ route('admin.jobs.bulkDelete') }}"
                onsubmit="return confirm(
                    'Saare Garbage / Non-Tripura jobs delete kar du? Ye action undo nahi ho sakta!'
                )"
            >

                @csrf

                <button
                    type="submit"
                    class="bg-red-700 hover:bg-red-800
                           text-white px-4 py-2 rounded-xl
                           font-bold text-sm"
                >
                    🔥 Delete All Garbage Jobs
                </button>

            </form>

        @endif

    </div>


    {{-- =========================================================
         JOB TABLE
    ========================================================== --}}

    <div
        class="bg-white border border-gray-200
               rounded-2xl overflow-hidden shadow-sm"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="bg-gray-50 border-b">

                    <tr>

                        <th class="p-4 font-black">
                            #
                        </th>

                        <th class="p-4 font-black">
                            Job Title
                        </th>

                        <th class="p-4 font-black">
                            Department
                        </th>

                        <th class="p-4 font-black">
                            Qualification
                        </th>

                        <th class="p-4 font-black">
                            Category
                        </th>

                        <th class="p-4 font-black">
                            Last Date
                        </th>

                        <th class="p-4 font-black">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($jobs as $job)

                        <tr
                            class="border-b hover:bg-gray-50 transition"
                        >

                            {{-- NUMBER --}}

                            <td class="p-4 text-gray-500 font-bold">

                                {{ $jobs->firstItem() + $loop->index }}

                            </td>


                            {{-- TITLE --}}

                            <td class="p-4">

                                <div class="font-black text-gray-900">

                                    {{ $job->title }}

                                </div>

                            </td>


                            {{-- DEPARTMENT --}}

                            <td class="p-4">

                                <span class="text-gray-600">

                                    {{ $job->department ?? 'Not Specified' }}

                                </span>

                            </td>


                            {{-- QUALIFICATION --}}

                            <td class="p-4">

                                {{ $job->qualification ?? 'Graduate' }}

                            </td>


                            {{-- CATEGORY --}}

                            <td class="p-4">

                                @if($job->category === 'Government')

                                    <span
                                        class="bg-green-100 text-green-700
                                               px-3 py-1 rounded-full
                                               text-xs font-bold"
                                    >
                                        Government
                                    </span>

                                @elseif($job->category === 'Private')

                                    <span
                                        class="bg-blue-100 text-blue-700
                                               px-3 py-1 rounded-full
                                               text-xs font-bold"
                                    >
                                        Private
                                    </span>

                                @else

                                    <span
                                        class="bg-gray-100 text-gray-700
                                               px-3 py-1 rounded-full
                                               text-xs font-bold"
                                    >
                                        {{ $job->category ?? 'Other' }}
                                    </span>

                                @endif

                            </td>


                            {{-- LAST DATE --}}

                            <td class="p-4">

                                @if($job->last_date)

                                    @php
                                        $lastDate = \Carbon\Carbon::parse($job->last_date);
                                        $today = \Carbon\Carbon::today();
                                    @endphp

                                    @if($lastDate->isPast())

                                        <span
                                            class="bg-red-100 text-red-700
                                                   px-3 py-1 rounded-full
                                                   text-xs font-bold"
                                        >
                                            Expired
                                        </span>

                                        <div class="text-xs mt-1 text-gray-500">
                                            {{ $lastDate->format('d M Y') }}
                                        </div>

                                    @else

                                        <span
                                            class="bg-green-100 text-green-700
                                                   px-3 py-1 rounded-full
                                                   text-xs font-bold"
                                        >
                                            {{ $lastDate->format('d M Y') }}
                                        </span>

                                    @endif

                                @else

                                    <span class="text-gray-400">
                                        Not Available
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}

                            <td class="p-4">

                                <div class="flex flex-wrap gap-2">


                                    {{-- VIEW --}}

                                    <a
                                        href="{{ route('jobs.show', $job->id) }}"
                                        target="_blank"
                                        class="bg-gray-700 hover:bg-gray-800
                                               text-white px-4 py-2
                                               rounded-lg text-xs font-bold"
                                    >
                                        👁 View
                                    </a>


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('admin.jobs.edit', $job->id) }}"
                                        class="bg-blue-600 hover:bg-blue-700
                                               text-white px-3 py-1.5
                                               rounded-lg text-xs font-bold"
                                    >
                                        ✏️ Edit
                                    </a>


                                    {{-- DELETE --}}

                                    <form
                                        action="{{ route('admin.jobs.destroy', $job->id) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Kya aap is job ko permanently delete karna chahte hain?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-600 hover:bg-red-700
                                                   text-white px-3 py-1.5
                                                   rounded-lg text-xs font-bold"
                                        >
                                            🗑️ Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="p-12 text-center"
                            >

                                <div class="text-4xl mb-3">
                                    📭
                                </div>

                                <div
                                    class="text-gray-600
                                           font-bold text-lg"
                                >
                                    No Jobs Found
                                </div>

                                <p class="text-gray-400 text-sm mt-1">
                                    Try another search or add a new job.
                                </p>

                                <a
                                    href="{{ route('admin.jobs.create') }}"
                                    class="inline-block mt-4
                                           bg-black text-white
                                           px-5 py-2 rounded-xl
                                           font-bold text-sm"
                                >
                                    + Add New Job
                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($jobs->hasPages())

            <div class="p-4 border-t">

                {{ $jobs->links() }}

            </div>

        @endif

    </div>

</div>

@endsection