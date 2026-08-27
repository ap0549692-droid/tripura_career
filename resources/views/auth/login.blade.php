@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <i class="bi bi-mortarboard-fill logo"></i>
    <h2 class="mt-2 fw-bold" style="color: #764ba2;">Tripura Career</h2>
    <p class="text-muted">Find & Apply for Government Jobs</p>
</div>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<form method="POST" action="/login">
    @csrf
    <div class="mb-3">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control form-control-lg" required autofocus>
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control form-control-lg" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        Login
    </button>
    <div class="text-center mt-3">
        <a href="/register">New user? Register here</a>
    </div>
</form>
@endsection