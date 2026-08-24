@extends('layouts.app')
@section('content')
<div class="container mt-4">
<h2 class="fw-bold">My Applications</h2>
<table class="table table-bordered mt-3">
<tr class="table-light"><th>#</th><th>Scholarship Name</th><th>Amount</th><th>Status</th><th>Action</th></tr>
@foreach($applications as $i => $app)
<tr>
<td>{{ $i+1 }}</td>
<td>{{ $app->scholarship->title ?? 'N/A' }}</td>
<td>₹{{ $app->scholarship->amount ?? 0 }}</td>
<td>{{ $app->status }}</td>
<td><a href="/applications/{{ $app->id }}/download" class="btn btn-sm btn-outline-dark">Download PDF</a></td>
</tr>
@endforeach
</table>
@if($applications->isEmpty())
<p class="text-center mt-5">No applications found. Pehle koi scholarship apply karo.</p>
@endif
</div>
@endsection