@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b bg-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-black text-gray-900">
                    ✏️ Edit Govt Job
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Update job notification details
                </p>
            </div>

            <a
                href="{{ route('admin.jobs.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2.5 rounded-xl font-bold text-sm text-center"
            >
                ← Back
            </a>

        </div>


        <div class="p-6">

            {{-- ERRORS --}}
            @if($errors->any())

                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl mb-6">

                    <div class="font-bold mb-2">
                        ⚠️ Please fix the following errors:
                    </div>

                    <ul class="list-disc ml-5 text-sm space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORM --}}
            <form
                action="{{ route('admin.jobs.update', $job->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                {{-- TITLE --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Job Title <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $job->title) }}"
                        class="w-full border border-gray-300 p-3 rounded-xl"
                        required
                    >

                </div>


                {{-- DEPARTMENT --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Department <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="department"
                        value="{{ old('department', $job->department) }}"
                        class="w-full border border-gray-300 p-3 rounded-xl"
                        required
                    >

                </div>


                {{-- LOCATION --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Location
                    </label>

                    <input
                        type="text"
                        name="location"
                        value="{{ old('location', $job->location ?? 'Tripura') }}"
                        class="w-full border border-gray-300 p-3 rounded-xl"
                    >

                </div>


                {{-- CATEGORY --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Category
                    </label>

                    <select
                        name="category"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
                    >

                        @foreach([
                            'Government',
                            'Banking',
                            'Defence',
                            'Railway',
                            'Teaching',
                            'Post Office',
                            'Other'
                        ] as $category)

                            <option
                                value="{{ $category }}"
                                {{ old('category', $job->category ?? 'Government') == $category ? 'selected' : '' }}
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- QUALIFICATION --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Qualification
                    </label>

                    <select
                        name="qualification"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
                    >

                        @foreach([
                            '10th Pass',
                            '12th Pass',
                            'Graduate',
                            'Post Graduate',
                            'Diploma',
                            'ITI'
                        ] as $qualification)

                            <option
                                value="{{ $qualification }}"
                                {{ old('qualification', $job->qualification ?? 'Graduate') == $qualification ? 'selected' : '' }}
                            >
                                {{ $qualification }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- LAST DATE --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Last Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        name="last_date"
                        value="{{ old('last_date', $job->last_date ? $job->last_date->format('Y-m-d') : '') }}"
                        class="w-full border border-gray-300 p-3 rounded-xl"
                        required
                    >

                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
<input name="syllabus_link" value="{{ $job->syllabus_link?? '' }}" placeholder="Syllabus Link" class="border rounded-xl px-4 py-2 text-sm w-full">
<input name="pyq_link" value="{{ $job->pyq_link?? '' }}" placeholder="PYQ Link" class="border rounded-xl px-4 py-2 text-sm w-full">
<input name="min_age" value="{{ $job->min_age?? 18 }}" placeholder="Min Age" class="border rounded-xl px-4 py-2 text-sm w-full">
<input name="max_age" value="{{ $job->max_age?? 40 }}" placeholder="Max Age" class="border rounded-xl px-4 py-2 text-sm w-full">
</div>
<textarea name="documents" placeholder="Documents comma separated" class="border rounded-xl px-4 py-2 text-sm w-full mt-3">{{ $job->documents?? '' }}</textarea>


                {{-- APPLY LINK --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        Apply Link <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="url"
                        name="apply_link"
                        value="{{ old('apply_link', $job->apply_link) }}"
                        class="w-full border border-gray-300 p-3 rounded-xl"
                        required
                    >

                </div>


                {{-- NOTIFICATION PDF --}}

<div class="mb-5">

    <label class="block font-bold text-sm text-gray-800 mb-2">
        📄 Notification PDF
    </label>


    @if($job->pdf_link)

        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-4">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>

                    <p class="font-bold text-red-700">
                        📄 Current Notification PDF
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        A notification PDF is already uploaded.
                    </p>

                </div>


                <a
                    href="{{ asset('storage/' . $job->pdf_link) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-block text-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-bold text-sm"
                >
                    📄 View PDF
                </a>

            </div>

        </div>

    @endif


    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Replace Notification PDF
    </label>


    <input
        type="file"
        name="pdf_link"
        accept="application/pdf,.pdf"
        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
    >


    <p class="text-xs text-gray-500 mt-2">
        Leave empty to keep the current PDF.
        Maximum size: 10MB.
    </p>

</div>


                {{-- DESCRIPTION --}}
                <div class="mb-5">

                    <label class="block font-bold text-sm mb-2">
                        📋 Job Description
                    </label>

                    <textarea
                        name="description"
                        rows="8"
                        placeholder="Enter complete job details..."
                        class="w-full border border-gray-300 p-3 rounded-xl resize-y"
                    >{{ old('description', $job->description) }}</textarea>

                    <p class="text-xs text-gray-500 mt-2">
                        Add eligibility, vacancy, selection process and other important details.
                    </p>

                </div>


                {{-- CURRENT IMAGE --}}
                @if($job->image)

                    <div class="mb-5">

                        <label class="block font-bold text-sm mb-2">
                            🖼️ Current Job Image
                        </label>

                        <div class="bg-gray-50 border rounded-2xl p-4">

                            <img
                                src="{{ asset('storage/' . $job->image) }}"
                                alt="{{ $job->title }}"
                                class="w-full max-w-sm h-56 object-cover rounded-xl border"
                            >

                            <p class="text-xs text-gray-500 mt-2">
                                Current image
                            </p>

                        </div>

                    </div>

                @endif


                {{-- REPLACE IMAGE --}}
                <div class="mb-6">

                    <label class="block font-bold text-sm mb-2">
                        🖼️ Replace Job Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                    </p>

                </div>


                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3">

                    <a
                        href="{{ route('admin.jobs.index') }}"
                        class="w-full sm:w-1/3 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-xl font-bold"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="w-full sm:w-2/3 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold"
                    >
                        ✏️ Update Job
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection