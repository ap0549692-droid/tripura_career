<!DOCTYPE html>
<html>
<head>
    <title>Application Receipt</title>
    <style>
        body { font-family: Arial; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .details { margin-top: 20px; }
        .details p { margin: 5px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Tripura Career Hub</h2>
        <h4>Scholarship Application Receipt</h4>
    </div>
    
    <div class="details">
        <p><b>Application ID:</b> {{ $application->id }}</p>
        <p><b>Name:</b> {{ $application->user->name }}</p>  {{-- user-> add kiya --}}
        <p><b>Email:</b> {{ $application->user->email }}</p> {{-- user-> add kiya --}}
        <p><b>Phone:</b> {{ $application->user->phone ?? 'N/A' }}</p> {{-- user-> add kiya --}}
        <p><b>Scholarship:</b> {{ $application->scholarship->title }}</p>
        <p><b>Amount:</b> ₹{{ $application->scholarship->amount }}</p>
        <p><b>Status:</b> {{ $application->status }}</p>
        <p><b>Applied On:</b> {{ $application->created_at->format('d-m-Y') }}</p>
    </div>
</body>
</html>