<div style="max-width:600px; margin:20px auto; padding:20px; border:2px solid #007bff; border-radius:10px">
<h3>🔥 PRTC Eligibility Checker</h3>
<select id="district" style="width:100%; padding:10px; margin:10px 0">
<option>West Tripura</option><option>Sepahijala</option><option>Gomati</option><option>Khowai</option><option>Dhalai</option><option>North Tripura</option><option>Unakoti</option><option>South Tripura</option>
</select>
<select id="caste" style="width:100%; padding:10px; margin:10px 0">
<option>General</option><option>ST</option><option>SC</option><option>OBC</option>
</select>
<button onclick="checkPRTC()" style="width:100%; padding:12px; background:#007bff; color:white; border:none; border-radius:5px">Check Karo</button>
<p id="result" style="margin-top:15px; font-weight:bold"></p>
</div>
<script>
function checkPRTC(){
let d=document.getElementById('district').value;
let c=document.getElementById('caste').value;
document.getElementById('result').innerHTML = `✅ Aap ${d} se ho (${c}) - Aap Tripura Govt Jobs ke liye ELIGIBLE ho. PRTC lagega. Hamare AI se pucho kaunse job ke liye.`;
}
</script>