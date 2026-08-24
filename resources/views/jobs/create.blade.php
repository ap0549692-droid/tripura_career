<!DOCTYPE html>
<html>
<head>
<title>Add Job - Tripura Career</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 shadow rounded">
<h2 class="text-2xl font-bold mb-4">Add New Govt Job</h2>
<form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data"><input type="hidden" name="_token" value="{{ csrf_token() }}">
<input name="title" placeholder="Job Title ex: TPSC" class="w-full border p-3 mb-3 rounded" required>
<input name="department" placeholder="Department ex: TPSC" class="w-full border p-3 mb-3 rounded" required>
<input name="qualification" placeholder="Qualification ex: Graduate" class="w-full border p-3 mb-3 rounded" required>
<label>Last Date</label>
<input type="date" name="last_date" class="w-full border p-3 mb-3 rounded" required>
<input name="apply_link" placeholder="Apply Link https://..." class="w-full border p-3 mb-3 rounded" required>
<input name="pdf_link" placeholder="PDF Link (optional)" class="w-full border p-3 mb-3 rounded">
<button class="w-full bg-green-600 text-white py-3 rounded font-bold">Add Job</button>
</form>
</div>
</body>
</html>