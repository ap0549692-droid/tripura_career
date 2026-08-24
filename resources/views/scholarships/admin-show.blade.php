@extends('layouts.app')
@section('content')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Application Detail #{{ $app->id }}</h3>
    <span class="badge bg-{{ $app->status == 'Approved' ? 'success' : ($app->status == 'Rejected' ? 'danger' : 'warning') }} fs-6">{{ $app->status }}</span>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="card p-4 h-100 shadow-sm">
        <h5 class="mb-3">👤 Student Info</h5>
        <p><b>Name:</b> {{ $app->name }}</p>
        <p><b>Email:</b> {{ $app->email }}</p>
        <p><b>Phone:</b> {{ $app->phone }}</p>
        <p><b>User ID:</b> {{ $app->user_id }}</p>
        <p><b>Applied On:</b> {{ \Carbon\Carbon::parse($app->created_at)->format('d-m-Y h:i A') }}</p>
        <p><b>Scholarship ID:</b> {{ $app->scholarship_id }}</p>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4 h-100 shadow-sm">
        <h5 class="mb-3">📄 Documents</h5>
        @php $docs = explode(',', $app->document_path); @endphp
        @foreach($docs as $doc)
          @if($doc)
            <div class="mb-2">
              <a href="{{ asset('storage/' . trim($doc)) }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">
                View Document {{ $loop->iteration }} 📎
              </a>
              <img src="{{ asset('storage/' . trim($doc)) }}" class="img-fluid mt-2 rounded border" style="max-height:200px">
            </div>
          @endif
        @endforeach
        @if(empty($app->document_path))
          <p class="text-muted">No documents uploaded</p>
        @endif
      </div>
    </div>
  </div>

  <div class="mt-4 d-flex gap-2">
    <a href="/admin/applications" class="btn btn-secondary">← Back to List</a>
    <a href="/admin/applications/approve/{{ $app->id }}" class="btn btn-success">Approve ✅</a>
    <a href="/admin/applications/reject/{{ $app->id }}" class="btn btn-danger">Reject ❌</a>
  </div>
</div>
@endsection