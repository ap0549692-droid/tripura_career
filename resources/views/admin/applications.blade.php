@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Admin Panel - All Applications</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Scholarship</th>
                <th>Applied On</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $key => $app)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $app->user->name }}</td>
                <td>{{ $app->scholarship->title }}</td>
                <td>{{ $app->created_at->format('d-m-Y') }}</td>
                <td><span class="badge bg-info">{{ $app->status }}</span></td>
             <td>
    <div style="display:flex; gap:8px;">
        
        <!-- DELETE FORM -->
        <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Pakka delete karna hai?')">Delete</button>
        </form>

        <!-- UPDATE STATUS FORM -->
        <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
            @csrf
           <select name="status" class="form-select form-select-sm" style="width:120px;" onchange="this.form.submit()">
    <option value="pending" {{ $app->status == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="approved" {{ $app->status == 'approved' ? 'selected' : '' }}>Approved</option>
    <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
</select>
<button type="submit" class="btn btn-primary btn-sm mt-1" style="display:none;">Update</button>
        </form>

    </div>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection