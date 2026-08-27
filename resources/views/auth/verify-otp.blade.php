@extends('layouts.guest')
@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold" style="color: #764ba2;">Verify OTP</h2>
    <p class="text-muted">Email pe OTP bheja hai</p>
    @if(session('otp_msg'))<div class="alert alert-success fw-bold">{{ session('otp_msg') }}</div>@endif
</div>
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
<form method="POST" action="/verify-otp">@csrf
    <div class="mb-3"><label class="form-label fw-semibold">6 Digit OTP</label><input type="text" name="otp" class="form-control form-control-lg text-center" style="letter-spacing:8px; font-size:24px;" required></div>
    <button class="btn w-100 btn-lg text-white" style="background: black;">Verify & Create Account</button>
</form>
@endsection