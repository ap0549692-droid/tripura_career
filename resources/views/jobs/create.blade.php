<!DOCTYPE html>
<html>
<head>
<title>Add Job - Tripura Career</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto mt-10 bg-white p-8 shadow-xl rounded-2xl border">
<h2 class="text-2xl font-black mb-6">Add New Govt Job - Upgraded 🚀</h2>

<form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<input name="title" placeholder="Job Title ex: TPSC Combined Service" class="w-full border p-3 mb-3 rounded-xl" required>

<div class="grid grid-cols-2 gap-3">
<input name="department" placeholder="Department ex: TPSC" class="w-full border p-3 mb-3 rounded-xl" required>
<input name="location" placeholder="Location ex: Tripura" value="Tripura" class="w-full border p-3 mb-3 rounded-xl" required>
</div>

<div class="grid grid-cols-2 gap-3">
<input name="qualification" placeholder="Qualification ex: Graduate" class="w-full border p-3 mb-3 rounded-xl" required>
<select name="category" class="w-full border p-3 mb-3 rounded-xl">
<option value="Government">Government</option>
<option value="TPSC">TPSC</option>
<option value="Police">Police</option>
<option value="JRBT">JRBT</option>
<option value="Scholarship">Scholarship</option>
</select>
</div>

{{-- NEW FIELDS --}}
<div class="grid grid-cols-2 gap-3 bg-blue-50 p-3 rounded-xl mb-3">
<div>
<label class="text-xs font-bold text-blue-600">Min Age</label>
<input type="number" name="min_age" value="18" class="w-full border p-3 rounded-xl">
</div>
<div>
<label class="text-xs font-bold text-blue-600">Max Age</label>
<input type="number" name="max_age" value="40" class="w-full border p-3 rounded-xl">
</div>
</div>

<div class="grid grid-cols-2 gap-3 mb-3">
<label class="flex items-center gap-2 border p-3 rounded-xl bg-gray-50"><input type="checkbox" name="prtc_required" value="1" checked> <span class="text-sm font-bold">PRTC Required?</span></label>
<input name="documents" placeholder="Documents ex: PRTC, Aadhaar, Photo" class="w-full border p-3 rounded-xl">
</div>

<label class="text-xs font-bold">Last Date</label>
<input type="date" name="last_date" class="w-full border p-3 mb-3 rounded-xl" required>

<input name="apply_link" placeholder="Apply Link https://..." class="w-full border p-3 mb-3 rounded-xl" required>

<div class="bg-orange-50 p-3 rounded-xl mb-3">
<p class="text-xs font-black text-orange-600 mb-2">📘 SYLLABUS & PYQ (Ye bharoge tabhi Live hoga)</p>
<input name="syllabus_link" placeholder="Syllabus PDF Drive Link https://drive.google.com/..." class="w-full border p-3 mb-2 rounded-xl">
<input name="pyq_link" placeholder="PYQ PDF Drive Link https://drive.google.com/..." class="w-full border p-3 rounded-xl">
</div>

<input name="pdf_link" type="file" accept=".pdf" class="w-full border p-3 mb-3 rounded-xl bg-gray-50">
<p class="text-[11px] text-gray-500 mb-3">Notification PDF upload karo</p>

<textarea name="description" placeholder="Job Description..." rows="4" class="w-full border p-3 mb-3 rounded-xl"></textarea>

<input type="file" name="image" accept="image/*" class="w-full border p-3 mb-3 rounded-xl">

<button class="w-full bg-black text-white py-3.5 rounded-xl font-bold hover:bg-gray-800">Add Job + Make Live 🚀</button>
</form>
</div>
</body>
</html>