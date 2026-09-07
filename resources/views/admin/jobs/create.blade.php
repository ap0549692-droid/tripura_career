@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-5 border-b bg-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-black text-gray-900">
                    ➕ Add Govt Job
                </h1>

                <p class="text-gray-500 text-sm mt-1">
                    Add a new government job notification
                </p>
            </div>

            <a
                href="{{ route('admin.jobs.index') }}"
                class="inline-block text-center bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2.5 rounded-xl font-bold text-sm transition"
            >
                ← Back
            </a>

        </div>


        {{-- FORM --}}
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


            <form
                action="{{ route('admin.jobs.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- JOB TITLE --}}
                <div class="mb-5">

                    <label
                        for="title"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Job Title <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Example: Tripura Police Constable 2026"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        required
                    >

                </div>


                {{-- DEPARTMENT --}}
                <div class="mb-5">

                    <label
                        for="department"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Department <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="department"
                        type="text"
                        name="department"
                        value="{{ old('department') }}"
                        placeholder="Example: Tripura Police"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        required
                    >

                </div>


                {{-- LOCATION --}}
                <div class="mb-5">

                    <label
                        for="location"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Location
                    </label>

                    <input
                        id="location"
                        type="text"
                        name="location"
                        value="{{ old('location', 'Tripura') }}"
                        placeholder="Example: Agartala, Tripura"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    >

                </div>


                {{-- CATEGORY --}}
                <div class="mb-5">

                    <label
                        for="category"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Category
                    </label>

                    <select
                        id="category"
                        name="category"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    >

                        @php
                            $categories = [
                                'Government',
                                'Banking',
                                'Defence',
                                'Railway',
                                'Teaching',
                                'Post Office',
                                'Other'
                            ];
                        @endphp

                        @foreach($categories as $category)

                            <option
                                value="{{ $category }}"
                                {{ old('category', 'Government') == $category ? 'selected' : '' }}
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- QUALIFICATION --}}
                <div class="mb-5">

                    <label
                        for="qualification"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Qualification
                    </label>

                    @php
                        $qualifications = [
                            '10th Pass',
                            '12th Pass',
                            'Graduate',
                            'Post Graduate',
                            'Diploma',
                            'ITI'
                        ];
                    @endphp

                    <select
                        id="qualification"
                        name="qualification"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    >

                        @foreach($qualifications as $qualification)

                            <option
                                value="{{ $qualification }}"
                                {{ old('qualification', 'Graduate') == $qualification ? 'selected' : '' }}
                            >
                                {{ $qualification }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- LAST DATE --}}
                <div class="mb-5">

                    <label
                        for="last_date"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Last Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="last_date"
                        type="date"
                        name="last_date"
                        value="{{ old('last_date') }}"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
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

                    <label
                        for="apply_link"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Apply Link <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="apply_link"
                        type="url"
                        name="apply_link"
                        value="{{ old('apply_link') }}"
                        placeholder="https://official-website.gov.in/apply"
                        class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        required
                    >

                    <p class="text-xs text-gray-500 mt-1">
                        Enter the official application website URL.
                    </p>

                </div>


                {{-- =========================================
                     NOTIFICATION PDF
                ========================================== --}}
                <div class="mb-5">

                    <label
                        for="pdf_link"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        📄 Notification PDF
                    </label>

                    <input
                        id="pdf_link"
                        type="file"
                        name="pdf_link"
                        accept="application/pdf,.pdf"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        Upload official job notification PDF. Maximum size: 10MB.
                    </p>

                </div>


                {{-- PDF PREVIEW --}}
                <div
                    id="pdfPreview"
                    class="hidden mb-5 bg-blue-50 border border-blue-200 rounded-xl p-4"
                >

                    <div class="flex items-center gap-3">

                        <div class="text-3xl">
                            📄
                        </div>

                        <div>

                            <p class="font-bold text-blue-800">
                                Selected PDF
                            </p>

                            <p
                                id="pdfName"
                                class="text-sm text-blue-600"
                            ></p>

                        </div>

                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="mb-5">

                    <label
                        for="description"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        Job Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        placeholder="Enter complete job details..."
                        class="w-full border border-gray-300 p-3 rounded-xl resize-y focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    >{{ old('description') }}</textarea>

                </div>


                {{-- JOB IMAGE --}}
                <div class="mb-6">

                    <label
                        for="image"
                        class="block font-bold text-sm text-gray-800 mb-2"
                    >
                        🖼️ Job Image
                    </label>

                    <input
                        id="image"
                        type="file"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        class="w-full border border-gray-300 p-3 rounded-xl bg-white"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                    </p>

                </div>


                {{-- BUTTONS --}}
                <div class="flex flex-col sm:flex-row gap-3">

                    <a
                        href="{{ route('admin.jobs.index') }}"
                        class="w-full sm:w-1/3 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-3 rounded-xl font-bold transition"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="w-full sm:w-2/3 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold shadow transition"
                    >
                        ➕ Add Job
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PDF FILE NAME PREVIEW --}}
<script>

    document.getElementById('pdf_link').addEventListener('change', function () {

        const preview = document.getElementById('pdfPreview');
        const name = document.getElementById('pdfName');

        if (this.files.length > 0) {

            name.textContent = this.files[0].name;

            preview.classList.remove('hidden');

        } else {

            preview.classList.add('hidden');

            name.textContent = '';

        }

    });

</script>

@endsection