<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Scholarship;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        try {
            $q = strtolower(trim($request->input('message', '')));
            
            if (empty($q) || $q == 'hii' || $q == 'hi' || $q == 'hello' || $q == 'hey') {
                $reply = "Hii! 👋 Main Tripura Career AI hu.<br><br>Bolo kya chahiye?<br>• <b>Latest Jobs</b><br>• <b>10th Jobs</b><br>• <b>12th Jobs</b><br>• <b>TPSC</b><br>• <b>PRTC kya hai?</b><br>• <b>Scholarship</b>";
                return response()->json(['reply' => $reply]);
            }

            if(str_contains($q, 'new') || str_contains($q, 'latest') || str_contains($q, 'job') || str_contains($q, 'tpsc')){
                $jobs = Job::latest()->take(3)->get();
                if($jobs->count() == 0){
                    $reply = "Abhi koi job database me nahi hai. Admin se /admin/jobs pe add karo.<br><br><a href='/jobs' class='bg-black text-white px-3 py-1 rounded-full text-xs'>Browse Jobs →</a>";
                } else {
                    $reply = "🔥 <b>Latest 3 Jobs:</b><br><br>";
                    foreach($jobs as $job){
                        $reply .= "• <a href='/jobs/{$job->id}' class='text-blue-600 underline font-semibold'>{$job->title}</a><br>";
                    }
                    $reply .= "<br><a href='/jobs' class='bg-black text-white px-3 py-2 rounded-full text-xs inline-block'>View All Jobs →</a>";
                }
            }
            elseif(str_contains($q, 'scholarship')){
                $s = Scholarship::latest()->take(2)->get();
                $reply = "🎓 <b>Latest Scholarships:</b><br><br>";
                foreach($s as $sc){
                    $reply .= "• {$sc->title}<br>";
                }
                $reply .= "<br><a href='/scholarships' class='text-blue-600 underline'>All Scholarships →</a>";
            }
            elseif(str_contains($q, 'prtc')){
                $reply = "<b>PRTC</b> = Permanent Resident of Tripura Certificate.<br>Tripura Govt Job ke liye mandatory hai. SDM Office se banta hai. Documents: Aadhaar, Birth Proof, Land record.<br><br><a href='/check-eligibility' class='text-blue-600 underline'>Check Eligibility →</a>";
            }
            elseif(str_contains($q, '10th')){
                $reply = "10th Pass ke liye: Tripura Police, JRBT Group D jobs available hai.<br><a href='/jobs?qualification=10th' class='text-blue-600 underline font-bold'>10th Jobs dekho →</a>";
            }
            elseif(str_contains($q, '12th')){
                $reply = "12th Pass ke liye: LDC, JRBT, TPSC jobs hai.<br><a href='/jobs?qualification=12th' class='text-blue-600 underline font-bold'>12th Jobs dekho →</a>";
            }
            else{
                $reply = "Haan bolo! 🙏 Aapne <b>'{$q}'</b> pucha.<br><br>Try karo: <b>'latest job'</b>, <b>'10th jobs'</b>, <b>'PRTC'</b>, <b>'scholarship'</b> likh ke bhejo.";
            }

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json(['reply' => "Server Error: " . $e->getMessage() . "<br><a href='/jobs' class='bg-black text-white px-3 py-1 rounded-full text-xs'>Browse Jobs</a>"]);
        }
    }
}