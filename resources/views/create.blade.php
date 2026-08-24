@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Apply for: {{ $scholarship->title }}</h2>
    <p class="text-muted">Last Date: {{ $scholarship->deadline }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('application.store', $scholarship->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Document PDF/JPG</label>
            <input type="file" name="document" class="form-control">
        </div>

        <h5 class="mt-4">Guidelines:</h5>
        <p>{{ $scholarship->guidelines ?? 'No guidelines provided.' }}</p>

        <button type="submit" class="btn btn-success">Submit Application</button>
    </form>
</div>
@endsection