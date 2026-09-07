@extends('layouts.app')
@section('content')
@php
    $syllabusMap = config('tripura.syllabus', []);
    $pyqMap = config('tripura.pyq', []);
    $dept = trim($job->department?? '');

    $finalSyllabus =!empty($job->syllabus_link)
     ? $job->syllabus_link
        : ($syllabusMap[$dept]?? $syllabusMap[strtoupper($dept)]?? $syllabusMap['default']?? 'https://tpsc.tripura.gov.in/sites/default/files/Tent_Exam_220626.pdf');

    $finalPyq =!empty($job->pyq_link)
     ? $job->pyq_link
        : ($pyqMap[$dept]?? $pyqMap[strtoupper($dept)]?? $pyqMap['default']?? 'https://tpsc.tripura.gov.in/previous-question-paper');

    $finalApply = $job->apply_link?? $job->official_link?? null;

    $allDocs = $job->documents? explode(',', $job->documents) : ['PRTC Certificate', 'Aadhaar Card', 'Qualification Certificate'];
@endphp

<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="flex gap-2 justify-end mb-3 text-[11px] font-bold">
        <button onclick="setLang('en')" id="btn-en" class="lang-btn px-3 py-1 rounded-full border bg-black text-white">English</button>
        <button onclick="setLang('bn')" id="btn-bn" class="lang-btn px-3 py-1 rounded-full border bg-white">বাংলা</button>
        <button onclick="setLang('kok')" id="btn-kok" class="lang-btn px-3 py-1 rounded-full border bg-white">Kokborok</button>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-7">
            <div class="mb-3 flex gap-2 flex-wrap">
                <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-xs font-bold">{{ $job->category?? 'Government' }}</span>
                @if($job->prtc_required?? true)
                <span class="inline-block bg-black/30 px-3 py-1 rounded-full text-xs font-bold" data-t="prtc_req">PRTC Required</span>
                @endif
                <span class="inline-block bg-green-500 px-3 py-1 rounded-full text-xs font-bold">✅ Anirban Verified</span>
            </div>
            <h1 class="text-3xl font-black">{{ $job->title }}</h1>
            <p class="mt-2 text-orange-100">{{ $job->department }}</p>
        </div>

        <div class="p-6">
            @if($job->image)
                <div class="mb-6 bg-gray-50 border border-gray-200 rounded-2xl overflow-hidden">
                    <img src="{{ asset('storage/'. $job->image) }}" alt="{{ $job->title }}" class="w-full max-h-[450px] object-contain">
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-7">
                <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-500 font-semibold" data-t="dept">Department</p><p class="font-bold text-gray-900 mt-1">{{ $job->department?? 'N/A' }}</p></div>
                <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-500 font-semibold" data-t="loc">Location</p><p class="font-bold text-gray-900 mt-1">{{ $job->location?? 'Tripura' }}</p></div>
                <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-500 font-semibold" data-t="qual">Qualification</p><p class="font-bold text-gray-900 mt-1">{{ $job->qualification?? $job->required_qualification?? 'N/A' }}</p></div>
                <div class="bg-red-50 rounded-xl p-4 border border-red-100">
                    <p class="text-xs text-red-500 font-semibold" data-t="last_date">Last Date</p>
                    <p class="font-bold text-red-600 mt-1">
                        @if($job->last_date) {{ \Carbon\Carbon::parse($job->last_date)->format('d M Y') }}
                        <span id="countdown" class="block text-[11px] mt-1 font-black"></span>
                        @else N/A @endif
                    </p>
                </div>
                <div class="bg-blue-50 rounded-xl p-4"><p class="text-xs text-blue-500 font-semibold" data-t="age_limit">Age Limit</p><p class="font-bold text-blue-700 mt-1">{{ $job->min_age?? 18 }} - {{ $job->max_age?? 40 }} Years</p></div>
                <div class="bg-green-50 rounded-xl p-4"><p class="text-xs text-green-600 font-semibold">Tools</p><a href="/tools/age-calculator" class="font-bold text-green-700 mt-1 block hover:underline" data-t="age_calc">🧮 Age Calculator →</a></div>
            </div>

            <div class="mb-7 bg-gradient-to-r from-black to-gray-800 rounded-2xl p-5 text-white flex flex-col sm:flex-row items-center justify-between gap-4">
                <div><h3 class="font-black text-lg" data-t="eligible_q">🤔 Am I Eligible for this Job?</h3><p class="text-xs text-gray-300 mt-1" data-t="eligible_sub">PRTC, Age, Qualification 10 sec me check karo</p></div>
                <button onclick="document.getElementById('elig-modal').classList.remove('hidden')" class="bg-orange-500 hover:bg-orange-600 px-6 py-2.5 rounded-full font-bold text-sm whitespace-nowrap" data-t="check_now">Check Now →</button>
            </div>

            <div class="mb-7 bg-orange-50 border border-orange-100 rounded-xl p-5">
                <h3 class="font-black text-gray-900 mb-2 flex justify-between items-center">
                    <span data-t="doc_req">📄 Documents Required</span>
                    <button onclick="window.print()" class="text-[10px] bg-black text-white px-3 py-1 rounded-full">🖨️ Print</button>
                </h3>
                <div class="text-sm text-gray-700 leading-6">
                    @foreach($allDocs as $doc)
                        <label class="inline-flex items-center gap-1.5 bg-white border px-3 py-1.5 rounded-full text-xs font-semibold mr-2 mb-2 cursor-pointer hover:bg-yellow-100">
                            <input type="checkbox" class="rounded"> {{ trim($doc) }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mb-7">
                <h2 class="text-xl font-black text-gray-900 mb-3" data-t="job_desc">📋 Job Description</h2>
                <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-7 whitespace-pre-line">{{ $job->description?? 'No job description available.' }}</div>
            </div>

            <div class="mb-7 bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-400 rounded-2xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="text-3xl">📍</div>
                    <div class="flex-1">
                        <h3 class="font-black text-gray-900 text-[15px]">Agartala ka ladka hu, isliye bol raha hu:</h3>
                        <p class="text-[13px] text-gray-700 mt-1.5 leading-relaxed">
                            Is job me <b>PRTC lagna hi lagna hai</b>. Bahar wali website ye nahi batayegi. Maine ye job <b>{{ $job->department?? 'official site' }}</b> se khud verify kiya hai.
                        </p>
                        <div class="mt-3 bg-white rounded-xl p-3 border border-yellow-200">
                            <p class="text-[12px] font-bold text-gray-800">PRTC kaha banta hai?</p>
                            <p class="text-[12px] text-gray-600 mt-1">📄 SDO Office, Agartala (Gorkhabasti) / Apne Sub-Division me. 7 din me ban jata hai.</p>
                            <p class="text-[12px] text-gray-600 mt-1">📝 Document: Aadhar, ROR, Parents PRTC.</p>
                        </div>
                        <a href="https://wa.me/919863807328?text=Bhai%20PRTC%20me%20help%20chahiye%20{{ urlencode($job->title) }}"
                           target="_blank"
                           class="mt-3 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-[13px] font-bold px-4 py-2.5 rounded-full">
                           <span>💬</span> PRTC me doubt hai? WhatsApp karo
                        </a>
                    </div>
                </div>
            </div>

            <div class="mb-4 grid grid-cols-1 gap-3">
                <a href="{{ $finalSyllabus }}" target="_blank" class="flex items-center justify-center gap-2 bg-blue-600 text-white py-3 px-5 rounded-xl font-bold hover:bg-blue-700 transition w-full">📘 Download Syllabus</a>
                <a href="{{ $finalPyq }}" target="_blank" class="flex items-center justify-center gap-2 bg-purple-600 text-white py-3 px-5 rounded-xl font-bold hover:bg-purple-700 transition w-full">📝 Download PYQ</a>
                @if($finalApply)
                <a href="{{ $finalApply }}" target="_blank" class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white py-3 px-5 rounded-xl font-bold transition shadow w-full" data-t="apply_now">🚀 Apply on Official Website</a>
                @endif
                @if($job->pdf_link)
                    <a href="{{ asset('storage/'. $job->pdf_link) }}" target="_blank" class="flex items-center justify-center bg-black text-white py-3 px-5 rounded-xl font-bold w-full" data-t="pdf">📄 Notification PDF</a>
                @endif
            </div>

            <div class="mt-6 text-center"><a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-blue-600 font-semibold" data-t="back">← Back to All Jobs</a></div>
        </div>
    </div>
</div>

<div id="elig-modal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4">
 <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-2xl">
  <h3 class="font-black text-lg" data-t="check_title">Eligibility Checker 🔍</h3>
  <input id="myAge" type="number" placeholder="Your Age" class="w-full border rounded-full px-4 py-2.5 mt-4 text-sm outline-none">
  <select id="myPrtc" class="w-full border rounded-full px-4 py-2.5 mt-2 text-sm"><option value="yes">PRTC - Yes</option><option value="no">PRTC - No</option></select>
  <button onclick="checkElig()" class="w-full bg-black text-white rounded-full py-3 mt-4 font-bold text-sm" data-t="check_btn">Check Eligibility</button>
  <p id="elig-result" class="mt-4 text-sm font-bold text-center p-3 rounded-xl hidden"></p>
  <button onclick="document.getElementById('elig-modal').classList.add('hidden')" class="w-full mt-3 text-xs text-gray-500 font-semibold">Close ✕</button>
 </div>
</div>

<script>
const dict = {
  en: {prtc_req:"PRTC Required",dept:"Department",loc:"Location",qual:"Qualification",last_date:"Last Date",age_limit:"Age Limit",age_calc:"🧮 Age Calculator →",eligible_q:"🤔 Am I Eligible for this Job?",eligible_sub:"PRTC, Age, Qualification check in 10 sec",check_now:"Check Now →",doc_req:"📄 Documents Required",job_desc:"📋 Job Description",apply_now:"🚀 Apply on Official Website",pdf:"📄 Notification PDF",back:"← Back to All Jobs",check_title:"Eligibility Checker 🔍",check_btn:"Check Eligibility"},
  bn: {prtc_req:"PRTC প্রয়োজন",dept:"বিভাগ",loc:"অবস্থান",qual:"যোগ্যতা",last_date:"শেষ তারিখ",age_limit:"বয়সসীমা",age_calc:"🧮 বয়স ক্যালকুলেটর →",eligible_q:"🤔 আমি কি এই চাকরির জন্য যোগ্য?",eligible_sub:"10 সেকেন্ডে চেক করুন",check_now:"এখনই চেক করুন →",doc_req:"📄 প্রয়োজনীয় কাগজপত্র",job_desc:"📋 চাকরির বিবরণ",apply_now:"🚀 এখনই আবেদন করুন",pdf:"📄 বিজ্ঞপ্তি PDF",back:"← সব চাকরি দেখুন",check_title:"যোগ্যতা পরীক্ষা 🔍",check_btn:"যোগ্যতা চেক করুন"},
  kok: {prtc_req:"PRTC Nangwi",dept:"Department",loc:"Bwsai",qual:"Rongma",last_date:"Jora Sal",age_limit:"Umar",age_calc:"🧮 Umar Calculator →",eligible_q:"🤔 Ang Kwthar Job No Eligible?",eligible_sub:"10 sec ni bisingo check khwlai di",check_now:"Check Khwlai Di →",doc_req:"📄 Documents Nangwi",job_desc:"📋 Job Ni Details",apply_now:"🚀 Apply Khwlai Di",pdf:"📄 Notification PDF",back:"← Gari Job Rok No Sudi",check_title:"Eligibility Nayo 🔍",check_btn:"Nayo"}
};
function setLang(l){
  localStorage.setItem('trip_lang', l);
  document.querySelectorAll('.lang-btn').forEach(b=>b.className='lang-btn px-3 py-1 rounded-full border bg-white text-black');
  document.getElementById('btn-'+l).className='lang-btn px-3 py-1 rounded-full border bg-black text-white';
  document.querySelectorAll('[data-t]').forEach(el=>{
    let k=el.getAttribute('data-t');
    if(dict[l][k]) el.innerText=dict[l][k];
  });
}
let saved = localStorage.getItem('trip_lang') || 'en'; setLang(saved);
function checkElig(){
  let minAge = {{ $job->min_age?? 18 }}; let maxAge = {{ $job->max_age?? 40 }};
  let needPrtc = {{ ($job->prtc_required?? true)? 'true' : 'false' }};
  let age = parseInt(document.getElementById('myAge').value);
  let prtc = document.getElementById('myPrtc').value;
  let res = document.getElementById('elig-result');
  if(!age){ res.classList.remove('hidden'); res.innerText="⚠️ Age daalo"; res.className="mt-4 text-sm font-bold text-center p-3 rounded-xl bg-yellow-50 text-yellow-700"; return; }
  res.classList.remove('hidden');
  if(age < minAge || age > maxAge){ res.innerHTML="❌ Not Eligible<br><span class='text-xs font-normal'>Required: "+minAge+"-"+maxAge+", You: "+age+"</span>"; res.className="mt-4 text-sm font-bold text-center p-3 rounded-xl bg-red-50 text-red-600 border"; return; }
  if(needPrtc && prtc=='no'){ res.innerHTML="❌ Not Eligible<br><span class='text-xs font-normal'>PRTC compulsory hai</span>"; res.className="mt-4 text-sm font-bold text-center p-3 rounded-xl bg-red-50 text-red-600 border"; return; }
  res.innerHTML="✅ Eligible Ho!"; res.className="mt-4 text-sm font-bold text-center p-3 rounded-xl bg-green-50 text-green-700 border";
}

// Countdown Logic
let ld = new Date("{{ $job->last_date }}").getTime();
let cdEl = document.getElementById('countdown');
if(cdEl && "{{ $job->last_date }}"){
  setInterval(()=>{
    let diff = ld - new Date().getTime();
    if(diff>0){
      let d = Math.floor(diff/(1000*60*60*24));
      let h = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
      cdEl.innerText = d<=3? `⏰ Sirf ${d} din ${h} ghanta baki! Jaldi karo` : `⏰ ${d} din ${h} ghanta baki`;
      if(d<=3) cdEl.classList.add('animate-pulse');
    } else {
      cdEl.innerText = "❌ Last Date Khatam";
    }
  },1000);
}
</script>
@endsection