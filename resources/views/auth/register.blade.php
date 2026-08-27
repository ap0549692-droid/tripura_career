@extends('layouts.guest')
@section('content')
<div class="text-center mb-4">
    <h2 class="fw-bold" style="color: #764ba2;">Create Account</h2>
    <p class="text-muted">OTP se verify hoga</p>
</div>
@if($errors->any())<div class="alert alert-danger">@foreach($errors->all() as $e){{ $e }}<br>@endforeach</div>@endif
<form method="POST" action="/register">@csrf
    <div class="mb-3"><label class="form-label fw-semibold">Full Name</label><input type="text" name="name" class="form-control form-control-lg" required></div>
    <div class="mb-3"><label class="form-label fw-semibold">Email</label><input type="email" name="email" class="form-control form-control-lg" required></div>
    <div class="mb-3"><label class="form-label fw-semibold">Password</label><input type="password" name="password" class="form-control form-control-lg" required></div>
    <button class="btn w-100 btn-lg text-white" style="background: #0a5c36;">Send OTP</button>
    <div class="text-center mt-3"><a href="/login">Already have account? Login</a></div>
</form>
@endsection