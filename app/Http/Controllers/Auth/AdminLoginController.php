<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller {
    public function showLoginForm(){
        return view('auth.admin-login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(Auth::attempt($credentials)){
            if(Auth::user()->is_admin == 1){
                return redirect('/dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email'=>'You are not Admin!']);
        }
        return back()->withErrors(['email'=>'Wrong credentials']);
    }
}