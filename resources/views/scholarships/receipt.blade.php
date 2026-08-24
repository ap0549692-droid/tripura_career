<!DOCTYPE html>
<html>
<head><style>body{font-family:Arial; padding:30px} .box{border:2px solid #000; padding:20px} h2{text-align:center}</style></head>
<body>
<div class="box">
<h2>Tripura Career Hub - Application Receipt</h2>
<hr>
<p><b>Scholarship Name:</b> {{ $application->scholarship->title }}</p>
<p><b>Student Name:</b> {{ $application->user->name }}</p>
<p><b>Amount:</b> ₹{{ $application->scholarship->amount }}</p>
<p><b>Status:</b> <span style="color:green; font-weight:bold">{{ $application->status }}</span></p>
<p><b>Applied Date:</b> {{ $application->created_at->format('d-m-Y') }}</p>
<br><br><p style="text-align:right">Signature</p>
</div>
</body>
</html>