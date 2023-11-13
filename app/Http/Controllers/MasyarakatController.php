<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Masyarakat;
use App\Http\Requests\StoreMasyarakatRequest;
use App\Http\Requests\UpdateMasyarakatRequest;

class MasyarakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrator.users.masyarakat',[
            'title' => 'Data Masyarakat',
            'masyarakats' => Masyarakat::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.users.regMas');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMasyarakatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nik' => 'required|max:16',
            'nama' => 'required|max:35',
            'username' => ['required', 'min:3', 'max:255', 'unique:masyarakats'],
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:13',
        ]);

        $validateData['password']= Hash::make($validateData['password']);

        Masyarakat::create($validateData);

        return redirect('administrator/masyarakat')->with('success', 'Registrasi Berhasil silakan login');
    // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function show(Masyarakat $masyarakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function edit($nik)
    {
        $dataMas = Masyarakat::findOrFail($nik);

        return view('administrator.users.edit_Mas',[
            'title' => 'Edit Masyarakat'
        ], compact('dataMas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMasyarakatRequest  $request
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nik)
    {
        $masyarakat = Masyarakat::findOrFail($nik);

        $rules = [
            'nik' => 'required',
            'nama' => 'required',
            'username' => 'required|min:3',
            'password' => 'required|min:5',
            'telp' => 'required|min:12|max:13'
        ];
        
        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        Masyarakat::where('nik', $masyarakat->nik)->update($validateData);

        return redirect('/administrator/masyarakat')->with('success', 'Data Masyarakat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Masyarakat  $masyarakat
     * @return \Illuminate\Http\Response
     */
    public function destroy($nik)
    {
        $masyarakat = Masyarakat::findOrFail($nik);

        $masyarakat->where('nik', $masyarakat->nik)->delete();

        return redirect('/administrator/masyarakat')->with('success', 'Data Masyarakat telah dihapus');

    }
}
