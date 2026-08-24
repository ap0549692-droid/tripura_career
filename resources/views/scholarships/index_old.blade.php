@extends('layouts.app')

@section('content')
<style>
    body { background: #f0f4ff; }
    .scholarship-card { border-radius: 12px; border: none; border-left: 4px solid #138808; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: 0.3s; background: #fff; }
    .scholarship-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(19,136,8,0.2); }
    .badge-blue { background: #0d6efd; color: white; border-radius: 20px; padding: 5px 12px; font-size: 12px; }
    .badge-red { background: #dc3545; color: white; border-radius: 20px; padding: 4px 10px; font-size: 11px; }
    .btn-apply { background: #dc3545; color: white; border-radius: 8px; font-weight: 600; border: none; }
    .btn-apply:hover { background: #bb2d3b; color: white; }
    .info-text { font-size: 14px; color: #555; }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #138808;">
            🎓 <span style="background: linear-gradient(90deg, #FF9933, #138808); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tripura Scholarships Portal</span>
        </h2>
        <p class="text-muted">"Shiksha hi Shakti" - Find & Apply for Govt Scholarships in Tripura 🌴</p>
        <small class="text-success fw-bold">Empowering Students of Tripura Since 2026</small>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="row">
        @forelse($scholarships as $index => $scholarship)
        <div class="col-md-4 mb-4">
            <div class="card scholarship-card h-100 p-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="badge-blue">#{{ $index + 1 }}</span>
                    <span class="badge" style="background: #FF9933; color: white;">Tripura Govt</span>
                    @if(\Carbon\Carbon::parse($scholarship->deadline)->diffInDays(now()) <= 30)
                        <span class="badge-red">Last 30 Days</span>
                    @endif
                </div>
                
                <h5 class="fw-bold mb-3">{{ $scholarship->title }}</h5>
                
                <p class="info-text mb-2">💰 <strong>Amount:</strong> ₹{{ number_format($scholarship->amount) }}</p>
                <p class="info-text mb-3">📅 <strong>Last Date:</strong> {{ \Carbon\Carbon::parse($scholarship->deadline)->format('d-m-Y') }}</p>
                
                @auth
                <a href="{{ route('scholarship.show', $scholarship->id) }}" class="btn btn-apply w-100 mb-2">
                    <i class="bi bi-file-earmark-text"></i> Apply + Guidelines
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-apply w-100 mb-2">Login to Apply</a>
                @endauth

            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-light">No scholarships found.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection