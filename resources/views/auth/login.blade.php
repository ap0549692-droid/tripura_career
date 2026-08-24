@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <i class="bi bi-mortarboard-fill logo"></i>
    <h2 class="mt-2 fw-bold" style="color: #764ba2;">Tripura Career</h2>
    <p class="text-muted">Find & Apply for Government Scholarships</p>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control form-control-lg" required autofocus>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control form-control-lg" required>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remember">
        <label class="form-check-label">Remember me</label>
    </div>

    <button type="submit" class="btn btn-primary w-100 btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        Login
    </button>

    <div class="text-center mt-3">
        <a href="{{ route('register') }}">New user? Register here</a>
    </div>
</form>

<div class="row text-center mt-4 pt-3 border-top">
    <div class="col">
        <h5 class="fw-bold">500+</h5>
        <small class="text-muted">Scholarships</small>
    </div>
    <div class="col">
        <h5 class="fw-bold">10K+</h5>
        <small class="text-muted">Students</small>
    </div>
    <div class="col">
        <h5 class="fw-bold">₹50Cr</h5>
        <small class="text-muted">Disbursed</small>
    </div>
</div>
@endsection