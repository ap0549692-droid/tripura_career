@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h3>{{ $scholarship->title }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6"><p><b>🏢 Provider:</b> {{ $scholarship->provider }}</p></div>
                <div class="col-md-6"><p><b>💰 Amount:</b> {{ is_numeric($scholarship->amount) ? '₹'.number_format($scholarship->amount) : $scholarship->amount }}</p></div>
                <div class="col-md-6"><p><b>📂 Category:</b> {{ $scholarship->category }}</p></div>
                <div class="col-md-6"><p><b>📅 Last Date:</b> {{ \Carbon\Carbon::parse($scholarship->last_date)->format('d-m-Y') }}</p></div>
            </div>
            
            <hr>
            <h5>✅ Eligibility:</h5>
            <p>{{ $scholarship->eligibility }}</p>
            
            <h5>📝 Description:</h5>
            <p>{{ $scholarship->description }}</p>
            
            @if($scholarship->document_path)
                <hr>
                <h5>📄 Documents / Guidelines:</h5>
                @php $files = explode(',', $scholarship->document_path); @endphp
                @foreach($files as $file)
                    <a href="{{ asset('storage/'.$file) }}" target="_blank" class="btn btn-sm btn-info mb-2 me-2">View Doc</a>
                @endforeach
            @endif
            
            <hr>
            <div class="d-flex gap-2 flex-wrap">
                {{-- 1. Official Site pe Apply --}}
                @if($scholarship->apply_link)
                    <a href="{{ $scholarship->apply_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">Apply on Official Site →</a>
                @endif

                {{-- 2. Tere site pe Apply --}}
                <a href="{{ route('application.create', $scholarship->id) }}" class="btn btn-danger btn-lg">Apply on TripuraCareer</a>

                {{-- 3. Back public list pe --}}
                <a href="{{ route('scholarships.index') }}" class="btn btn-secondary btn-lg">← Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection