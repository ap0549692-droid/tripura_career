<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }
    public function showOtp(){ return view('auth.verify-otp'); }

    public function register(Request $request){
        $request->validate(['name'=>'required','email'=>'required|email|unique:users','password'=>'required|min:6']);
        $otp = rand(100000, 999999);
        session(['otp'=>$otp, 'reg_data'=>$request->all()]);
        // Testing ke liye OTP screen pe dikhayenge, email baad me lagayenge
        return redirect('/verify-otp')->with('otp_msg', "Tera OTP hai: $otp");
    }

    public function verifyOtp(Request $request){
        if($request->otp == session('otp')){
            $data = session('reg_data');
            $user = User::create(['name'=>$data['name'],'email'=>$data['email'],'password'=>Hash::make($data['password'])]);
            Auth::login($user);
            return redirect('/')->with('success','Welcome!');
        }
        return back()->with('error','Galat OTP!');
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/');
        }
        return back()->with('error','Email ya Password galat');
    }
    public function logout(){ Auth::logout(); return redirect('/'); }
}