@extends('layouts.app')
@section('content')
<style>
    body { background: #f0f4ff; }
    .app-card { 
        background: #fff; 
        border-radius: 12px; 
        border-left: 4px solid #138808; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        transition: 0.3s;
    }
    .app-card:hover { transform: translateY(-3px); }
</style>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #138808;">📄 My Applications</h2>
        <p class="text-muted">Track all your scholarship applications here</p>
    </div>
    
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="row">
        @forelse($applications as $app)
        <div class="col-md-6 mb-4">
            <div class="card app-card p-3 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold">{{ $app->scholarship->title }}</h5>
                    <span class="badge 
                        @if($app->status == 'pending') bg-warning text-dark
                        @elseif($app->status == 'approved') bg-success
                        @else bg-danger @endif">
                        {{ ucfirst($app->status) }}
                    </span>
                </div>
                <p class="mb-1">🏢 {{ $app->scholarship->provider }}</p>
                <p class="mb-1">💰 <strong>₹{{ number_format($app->scholarship->amount) }}</strong></p>
                <small class="text-muted">Applied on: {{ $app->created_at->format('d M Y') }}</small>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-light text-center">
                <h5>😔 No Applications Yet</h5>
                <p>Apply to a scholarship to see it here.</p>
                                <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Pakka delete karna hai?')">Delete</button>
</form>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection