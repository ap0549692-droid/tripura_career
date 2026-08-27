@extends('layouts.app')
@section('title','Check Eligibility - Tripura Jobs | Kokborok | বাংলা')
@section('content')
<div class="max-w-4xl mx-auto px-3 py-6">
<div class="flex justify-between items-center">
<h1 class="font-black text-xl" id="mainTitle">🔍 Check Your Eligibility</h1>
<select id="langSwitcher" class="border rounded-full px-4 py-2 text-xs font-bold bg-white">
<option value="en">English</option>
<option value="kok">Kokborok</option>
<option value="bn">বাংলা</option>
</select>
</div>
<p class="text-xs text-gray-500 mt-1" id="subTitle">Select your details & see jobs you can apply</p>

<div class="bg-white rounded-[20px] border p-5 mt-5 grid md:grid-cols-4 gap-3">
<div><label class="text-[11px] font-bold" id="l_qual">Qualification</label>
<select id="qual" class="w-full mt-1 border rounded-full px-3 py-2.5 text-sm">
<option value="">All</option><option>10th Pass</option><option>12th Pass</option><option>Graduate</option><option>Post Graduate</option>
</select></div>
<div><label class="text-[11px] font-bold" id="l_dist">District</label>
<select id="dist" class="w-full mt-1 border rounded-full px-3 py-2.5 text-sm">
<option value="">All Tripura</option><option>West Tripura</option><option>Sepahijala</option><option>Gomati</option><option>South Tripura</option><option>Dhalai</option><option>Khowai</option><option>Unakoti</option><option>North Tripura</option>
</select></div>
<div><label class="text-[11px] font-bold" id="l_prtc">PRTC</label>
<select id="prtc" class="w-full mt-1 border rounded-full px-3 py-2.5 text-sm">
<option value="">Any</option><option value="Yes">Yes - PRTC Available</option><option value="No">No PRTC</option>
</select></div>
<div class="flex items-end"><button onclick="filterJobs()" class="w-full bg-black text-white rounded-full py-2.5 text-sm font-black" id="btnCheck">Check Jobs →</button></div>
</div>

<div id="resultCount" class="mt-6 font-black text-sm"></div>
<div id="jobList" class="mt-3 space-y-3">
@forelse($jobs as $job)
<div class="job-card bg-white rounded-2xl border p-4 border-l-4 border-l-orange-500" data-qual="{{ strtolower($job->qualification) }}" data-dist="{{ strtolower($job->district) }}" data-prtc="{{ strtolower($job->prtc?? 'yes') }}">
<h3 class="font-bold text-[13px]">{{ $job->title }}</h3>
<p class="text-[11px] text-gray-500 mt-1">📍 {{ $job->district?? 'Tripura' }} | 🎓 {{ $job->qualification?? 'Any' }} | PRTC: {{ $job->prtc?? 'Required' }}</p>
<div class="mt-2 flex gap-2"><a href="/jobs/{{ $job->id }}" class="text-xs bg-black text-white px-4 py-1.5 rounded-full font-bold">View →</a><a href="https://wa.me/?text={{ urlencode($job->title.' '.url('/jobs/'.$job->id)) }}" target="_blank" class="text-xs bg-green-500 text-white px-3 py-1.5 rounded-full">Share</a></div>
</div>
@empty
<p class="text-center text-sm py-10">No jobs in database. Add jobs from admin panel first.</p>
@endforelse
</div>
</div>

<script>
const dict = {
  en: {main:"🔍 Check Your Eligibility", sub:"Select your details & see jobs you can apply", qual:"Qualification", dist:"District", prtc:"PRTC", btn:"Check Jobs →", count:" eligible jobs found for you"},
  kok: {main:"🔍 Nwng Eligible Kh? Nayo", sub:"Nwng details chayo aro job nuyo", qual:"Pass Certificate", dist:"District", prtc:"PRTC Tongo?", btn:"Job Nayo →", count:" job nwng bagwi eligible tongu"},
  bn: {main:"🔍 যোগ্যতা পরীক্ষা করুন", sub:"আপনার তথ্য দিন, কোন চাকরির জন্য যোগ্য দেখুন", qual:"যোগ্যতা", dist:"জেলা", prtc:"PRTC আছে?", btn:"চাকরি দেখুন →", count:" টি চাকরির জন্য আপনি যোগ্য"}
};
document.getElementById('langSwitcher').addEventListener('change', function(){
  let l = this.value;
  document.getElementById('mainTitle').innerText = dict[l].main;
  document.getElementById('subTitle').innerText = dict[l].sub;
  document.getElementById('l_qual').innerText = dict[l].qual;
  document.getElementById('l_dist').innerText = dict[l].dist;
  document.getElementById('l_prtc').innerText = dict[l].prtc;
  document.getElementById('btnCheck').innerText = dict[l].btn;
});
function filterJobs(){
  let q = document.getElementById('qual').value.toLowerCase();
  let d = document.getElementById('dist').value.toLowerCase();
  let p = document.getElementById('prtc').value.toLowerCase();
  let cards = document.querySelectorAll('.job-card');
  let c=0;
  cards.forEach(card=>{
    let cq = card.dataset.qual; let cd = card.dataset.dist; let cp = card.dataset.prtc;
    let show = true;
    if(q &&!cq.includes(q) && cq!='') show=false;
    if(d &&!cd.includes(d) && cd!='') show=false;
    if(p=='yes' && cp.includes('no')) show=false;
    card.style.display = show? 'block':'none';
    if(show) c++;
  });
  let lang = document.getElementById('langSwitcher').value;
  document.getElementById('resultCount').innerText = c + dict[lang].count;
}
</script>
@endsection