<?php $__env->startSection('title','Tripura Jobs & Scholarships 2026 - Govt Jobs & Scholarships in Tripura | PRTC Verified'); ?>
<?php $__env->startSection('content'); ?>
<div class="space-y-8">


<div class="bg-white rounded-[32px] border p-6 md:p-10 text-center shadow-sm">
<div class="inline-flex gap-2 text-[10px] font-black">
<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">🔥 <?php echo e($jobs->count()+20); ?> Active Jobs</span>
<span class="bg-red-100 text-red-700 px-3 py-1 rounded-full animate-pulse">⏰ <?php echo e(rand(2,8)); ?> Last Date Tomorrow</span>
<span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">✓ Daily Update</span>
</div>

<h1 class="font-black text-[28px] md:text-[48px] leading-[1.1] mt-4">Tripura's No.1 <span class="text-orange-600">Govt Job & Scholarship</span> Portal</h1>
<p class="text-[13px] text-gray-500 mt-3 max-w-xl mx-auto">No fake jobs. Only verified TPSC, JRBT, Tripura Police jobs & Scholarships. Check eligibility in Kokborok, Bengali & English.</p>


<form action="/jobs" method="GET" class="mt-6 max-w-xl mx-auto flex gap-2 items-center" id="homeSearchForm">
    <div class="relative flex-1">
        <input id="homeVoiceInput" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search - TPSC, Police, Scholarship, 10th Pass..." class="w-full border rounded-full pl-5 pr-12 py-3 text-sm outline-none focus:border-black bg-white">
        <button type="button" id="homeVoiceBtn" onclick="startHomeVoice()" class="absolute right-1.5 top-1.5 bg-black text-white w-9 h-9 rounded-full flex items-center justify-center hover:bg-gray-800 text-[14px]">
            🎤
        </button>
    </div>
    <button class="bg-black text-white px-6 py-3 rounded-full text-sm font-black">Search</button>
</form>
<p id="homeVoiceStatus" class="text-[11px] text-orange-600 mt-2 font-bold hidden"></p>

<div class="mt-5 flex flex-wrap gap-2 justify-center">
<a href="/check-eligibility" class="bg-black text-white px-6 py-3 rounded-full text-[13px] font-black">🔍 Check Eligibility - Kokborok | বাংলা</a>
<a href="/jobs" class="border px-6 py-3 rounded-full text-[13px] font-bold bg-white">Browse All Jobs →</a>
</div>

<p class="text-[11px] text-gray-400 mt-4 font-semibold">Trusted by 15,247+ students from Agartala, Udaipur, Dharmanagar, Kailashahar</p>
</div>


<div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar">
<a href="/jobs?qualification=10th" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">10th Pass</a>
<a href="/jobs?qualification=12th" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">12th Pass</a>
<a href="/jobs?qualification=Graduate" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">Graduate</a>
<a href="/jobs?q=police" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">🚓 Police</a>
<a href="/jobs?q=tpsc" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">TPSC</a>
<a href="/jobs?q=jrbt" class="whitespace-nowrap bg-white border px-4 py-2 rounded-full text-xs font-bold hover:bg-black hover:text-white">JRBT</a>
<a href="/scholarships" class="whitespace-nowrap bg-blue-600 text-white border border-blue-600 px-4 py-2 rounded-full text-xs font-bold">🎓 Scholarships</a>
<a href="/jobs?prtc=yes" class="whitespace-nowrap bg-orange-600 text-white border border-orange-600 px-4 py-2 rounded-full text-xs font-bold">PRTC Only ✓</a>
</div>


<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[17px]">🔥 Latest Govt Jobs</h2><a href="/jobs" class="text-[11px] font-bold border px-4 py-1.5 rounded-full bg-white">View All</a></div>
<div class="grid md:grid-cols-2 gap-3 mt-3">
<?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<?php $daysLeft = $job->deadline? \Carbon\Carbon::parse($job->deadline)->diffInDays(now(), false) : 10; ?>
<div class="bg-white rounded-2xl border p-4 border-l-4 <?php echo e($daysLeft <= 3? 'border-l-red-500' : 'border-l-orange-500'); ?> hover:shadow-md transition">
<div class="flex justify-between">
<span class="text-[9px] font-black bg-green-100 text-green-700 px-2 py-1 rounded-full">VERIFIED</span>
<?php if($daysLeft <= 3 && $daysLeft >=0): ?>
<span class="text-[9px] font-black bg-red-600 text-white px-2 py-1 rounded-full animate-pulse">🔴 LAST <?php echo e($daysLeft); ?> DAYS!</span>
<?php endif; ?>
</div>
<h3 class="font-bold text-[13px] mt-2 leading-tight line-clamp-2"><?php echo e($job->title); ?></h3>
<p class="text-[11px] text-gray-500 mt-1">📍 <?php echo e($job->district?? 'Tripura'); ?> | 🎓 <?php echo e($job->qualification?? 'Any'); ?> | ⏰ <?php echo e($job->deadline? \Carbon\Carbon::parse($job->deadline)->format('d M') : 'Soon'); ?></p>
<div class="mt-3 flex gap-2">
<a href="<?php echo e(route('login')); ?>" class="bg-black text-white px-4 py-2 rounded-full text-sm">
  View Details →
</a>
<a href="https://wa.me/?text=<?php echo e(urlencode($job->title.' '.url('/jobs/'.$job->id))); ?>" target="_blank" class="text-xs border px-3 py-1.5 rounded-full">Share</a>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<p class="text-sm text-gray-400 col-span-2 text-center py-10">No jobs yet - Add from Admin</p>
<?php endif; ?>
</div>
</div>


<div class="grid md:grid-cols-2 gap-6">
<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[15px]">🎫 Admit Cards</h2><a href="/admit-cards" class="text-[11px] font-bold">View All →</a></div>
<div class="mt-3 space-y-2">
<?php $__empty_1 = true; $__currentLoopData = $admitCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="bg-white border rounded-xl p-3 flex justify-between items-center">
<p class="text-xs font-bold"><?php echo e($ad->title); ?></p><a href="<?php echo e($ad->link?? '/admit-cards'); ?>" class="text-[10px] bg-blue-600 text-white px-3 py-1 rounded-full">Download</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="bg-white border rounded-xl p-4 text-xs text-gray-400">No admit cards</div>
<?php endif; ?>
</div>
</div>
<div>
<div class="flex justify-between items-center"><h2 class="font-black text-[15px]">🎓 Scholarships</h2><a href="/scholarships" class="text-[11px] font-bold">View All →</a></div>
<div class="mt-3 space-y-2">
<?php $__empty_1 = true; $__currentLoopData = $scholarships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="bg-white border rounded-xl p-3 flex justify-between items-center border-l-4 border-l-blue-500">
<p class="text-xs font-bold"><?php echo e(\Illuminate\Support\Str::limit($s->title,45)); ?></p><a href="/scholarships/<?php echo e($s->id); ?>" class="text-[10px] bg-black text-white px-3 py-1 rounded-full">Apply</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="bg-white border rounded-xl p-4 text-xs text-gray-400">No scholarships</div>
<?php endif; ?>
</div>
</div>
</div>

</div>


<script>
function startHomeVoice(){
    const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
    if(!SR){ alert("Voice search sirf Chrome me kaam karta hai, Chrome me kholo"); return; }
    const rec = new SR();
    rec.lang = 'en-IN'; // English + Kokborok + Bangla mix sab sun lega
    rec.interimResults = false;

    const input = document.getElementById('homeVoiceInput');
    const btn = document.getElementById('homeVoiceBtn');
    const status = document.getElementById('homeVoiceStatus');
    const form = document.getElementById('homeSearchForm');

    rec.onstart = ()=>{
        btn.innerHTML = "🔴";
        btn.classList.add('animate-pulse');
        status.classList.remove('hidden');
        status.innerText = "Sun raha hu... bolo - TPSC jobs / Borok ni job / পুলিশের চাকরি";
    };
    rec.onresult = (e)=>{
        const text = e.results[0][0].transcript;
        input.value = text;
        status.innerText = "Mil gaya: '" + text + "' - Search kar raha hu...";
        setTimeout(()=>{ form.submit(); }, 700);
    };
    rec.onerror = ()=>{ status.innerText = "Awaz clear nahi aayi, fir se try karo"; };
    rec.onend = ()=>{ btn.innerHTML = "🎤"; btn.classList.remove('animate-pulse'); };
    rec.start();
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tripura-career\resources\views/home.blade.php ENDPATH**/ ?>