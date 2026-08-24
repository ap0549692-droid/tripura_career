@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <i class="bi bi-person-plus-fill logo"></i>
    <h2 class="mt-2 fw-bold" style="color: #764ba2;">Create Account</h2>
    <p class="text-muted">Join Tripura Career</p>
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

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" name="name" class="form-control form-control-lg" required autofocus>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control form-control-lg" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control form-control-lg" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        Register
    </button>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Already have account? Login</a>
    </div>
</form>
@endsection