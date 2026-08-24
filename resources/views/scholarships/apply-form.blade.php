@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Apply for: {{ $scholarship->title }}</h3>
    <form method="POST" action="{{ route('scholarships.apply.store', $scholarship->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
    <label>Required Documents:</label>
    <small class="text-muted d-block">Upload: 1. Marksheet 2. Caste Certificate 3. Income Certificate 4. Aadhar Card</small>
    <input type="file" name="documents[]" class="form-control" multiple accept=".pdf,.jpg,.png" required>
    <small class="text-muted">You can select multiple files. PDF, JPG, PNG only. Max 2MB each</small>
</div>
        <button type="submit" class="btn btn-success">Submit Application</button>
    </form>
</div>
@endsection