<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Scholarship;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $q = strtolower($request->message);
        $reply = "";

        if(str_contains($q, 'new') || str_contains($q, 'latest') || str_contains($q, 'job')){
            $jobs = Job::latest()->take(3)->get();
            $reply = "🔥 Latest 3 Jobs:<br>";
            foreach($jobs as $job){
                $reply .= "• <a href='/jobs/{$job->id}' class='text-blue-600 underline'>{$job->title}</a><br>";
            }
            $reply .= "<br><a href='/jobs' class='bg-black text-white px-3 py-1 rounded-full text-[10px]'>View All Jobs →</a>";
        }
        elseif(str_contains($q, 'scholarship')){
            $s = Scholarship::latest()->take(2)->get();
            $reply = "🎓 Latest Scholarships:<br>";
            foreach($s as $sc){
                $reply .= "• {$sc->title}<br>";
            }
        }
        elseif(str_contains($q, 'prtc')){
            $reply = "<b>PRTC</b> = Permanent Resident of Tripura Certificate. Tripura Govt Job ke liye mandatory hai. SDM Office se banta hai. Documents: Aadhaar, Birth Proof, Land record.";
        }
        elseif(str_contains($q, '10th')){
            $reply = "10th Pass ke liye: Tripura Police, JRBT Group D, Forest Guard jobs available hai. <a href='/jobs?qualification=10th' class='text-blue-600 underline'>10th Jobs dekho →</a>";
        }
        elseif(str_contains($q, '12th')){
            $reply = "12th Pass ke liye: LDC, JRBT, TPSC jobs hai. <a href='/jobs?qualification=12th' class='text-blue-600 underline'>12th Jobs dekho →</a>";
        }
        else{
            $reply = "Haan bolo! 🙏 Main aapki help kar sakta hu: <br>• Latest Jobs<br>• Scholarship<br>• PRTC kya hai?<br>• 10th/12th Jobs<br><br>Aap 'latest job' likh ke bhejo.";
        }

        return response()->json(['reply' => $reply]);
    }
}