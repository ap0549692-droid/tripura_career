<!DOCTYPE html>
<html>
<head>
    <title>Scholarship Application</title>
    <style> 
        body{font-family: DejaVu Sans, Arial; padding:30px;} 
        h1{text-align:center; color:#0d6efd;} 
        hr{margin:20px 0;} 
        table{width:100%; border-collapse: collapse;}
        td{padding:8px; border-bottom:1px solid #ddd;}
    </style>
</head>
<body>
    <h1>{{ $app->scholarship->name }}</h1>
    <hr>
    <table>
        <tr><td><b>Application ID:</b></td><td>#{{ $app->id }}</td></tr>
        <tr><td><b>Student Name:</b></td><td>{{ $app->user->name }}</td></tr>
        <tr><td><b>Email:</b></td><td>{{ $app->user->email }}</td></tr>
        <tr><td><b>Scholarship Amount:</b></td><td>₹{{ $app->scholarship->amount }}</td></tr>
        <tr><td><b>Applied On:</b></td><td>{{ $app->created_at->format('d-m-Y h:i A') }}</td></tr>
        <tr><td><b>Status:</b></td><td><b>{{ ucfirst($app->status) }}</b></td></tr>
    </table>
    <br><br>
    <p style="text-align:center; font-size:12px;">This is a computer generated application form</p>
</body>
</html>