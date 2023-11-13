<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('login',[
            'title' => 'Login Pengaduan Masyarakat'
        ]);
    }
    public function postLogin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        

        // if(auth('web')->attempt($credentials)){
        //     $request->session()->regenerate();
        //      return redirect('/dashboard');
        // }
        if(Auth::guard('masyarakat')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        if(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        if(Auth::guard('petugas')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/dashboard');
        }


        // if(Auth::guard('masyarakat')->attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect('/dashboard');
        // }

        // return back()->with('loginError', 'Login Gagal');
        // if(Auth::guard('petugas')->attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect('dashboard');
        // }

        // return back()->withErrors([
        //     'username' => 'Username atau password salah',
        // ])->onlyInput('username');
        // dd($request);

        return back()->with('loginError', 'Login Gagal');

        // if(Auth::guard('masyarakat')->attempt(['username' => $request->username, 'password' => $request->password])){
        //     return redirect('/dashboard');
        // }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
