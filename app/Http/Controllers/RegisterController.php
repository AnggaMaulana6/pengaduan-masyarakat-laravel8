<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('masyarakat.register');
    }
    public function indexAd(){
        return view('administrator.registrasi');
    }
    public function indexMas(){
        return view('administrator.users.masyarakat');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nik' => 'required|max:16',
            'nama' => 'required|max:35',
            'username' => ['required', 'min:3', 'max:255', 'unique:masyarakats'],
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:13',
        ]);

        $validateData['password']= Hash::make($validateData['password']);

        Masyarakat::create($validateData);

        return redirect('login')->with('success', 'Registrasi Berhasil silakan login');
    }
    public function create(Request $request){
        $validateData = $request->validate([
            // 'id_petugas' => 'required',
            'nama_petugas' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:petugas'],
            'email' => 'required|email|unique:petugas',
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:15',
            'level' => 'required'

        ]);

        $validateData['password']= Hash::make($validateData['password']);

        Petugas::create($validateData);

        return redirect('login')->with('success', 'Registrasi Berhasil silakan login');
        // dd($request);
    }
}
