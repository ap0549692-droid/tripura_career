<!DOCTYPE html>
<html>
<head>
    <title>Admin Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>All Scholarship Applications</h2>

    <form method="GET" action="/admin/applications" class="mb-3">
    <div class="input-group">
        <a href="{{ route('admin.applications.export') }}" class="btn btn-success mb-3">📊 Download Excel</a>
        <input type="text" name="search" class="form-control" placeholder="Email" value="{{ request('search') }}">
        <select name="status" class="form-select">
    <option value="" {{ request('status')=='' ? 'selected' : '' }}>All Status</option>
    <option value="Pending" {{ request('status')=='Pending' ? 'selected' : '' }}>Pending</option>
    <option value="Approved" {{ request('status')=='Approved' ? 'selected' : '' }}>Approved</option>
    <option value="Rejected" {{ request('status')=='Rejected' ? 'selected' : '' }}>Rejected</option>
</select>
        <button class="btn btn-primary">Search</button>
    </div>
</form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Phone</th>
                <th>Scholarship</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    @foreach($applications as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->phone }}</td>
        <td>{{ $item->scholarship_name ?? $item->scholarship->title ?? 'N/A' }}</td>
        <td>
    @if($item->status == 'Pending')
        <span class="badge bg-warning text-dark">{{ $item->status }}</span>
    @elseif($item->status == 'Approved')
        <span class="badge bg-success">{{ $item->status }}</span>
    @else
        <span class="badge bg-danger">{{ $item->status }}</span>
    @endif
</td>
       <td>
  <div style="display:flex; gap:5px;">
    <form action="{{ route('admin.applications.status', $item->id) }}" method="POST">
      @csrf
      <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="Pending" {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending</option>
        <option value="Approved" {{ $item->status == 'Approved' ? 'selected' : '' }}>Approved</option>
        <option value="Rejected" {{ $item->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
      </select>
    </form>
    <a href="/admin/applications/view/{{ $item->id }}" class="btn btn-primary btn-sm">View</a>
  </div>
</td>
    </tr>
    @endforeach
</tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
    
</div>
</div>
</body>
</html>