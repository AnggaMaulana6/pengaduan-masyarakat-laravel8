<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Petugas;
use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->Authorize('admin');
        return view('administrator.users.petugas',[
            'title' => 'Data Petugas',
            'petugass' => Petugas::all()
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrator.users.reqPet');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePetugasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_petugas' => 'required|max:35',
            'email' => 'required|email|unique:petugas',
            'username' => ['required', 'min:3', 'max:255', 'unique:petugas'],
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:13',
            'level' => 'required',
        ]);

        $validateData['password']= Hash::make($validateData['password']);

        Petugas::create($validateData);

        return redirect('administrator/petugas')->with('success', 'Registrasi Berhasil silakan login');
    // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);

        return view('administrator.users.edit_petugas',[
            'title' => 'Edit Petugas',
        ], compact('petugas'));
            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePetugasRequest  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_petugas)
    {
        $p = Petugas::find($id_petugas);

        $rules = [
            'nama_petugas' => 'required|max:35',
            'email' => 'required|email',
            'username' => ['required', 'min:3', 'max:255'],
            'password' => 'required|min:5|max:255',
            'telp' => 'required|min:11|max:13',
            // 'level' => 'required'
        ];
        
        $validateData = $request->validate($rules);
        $validateData['password'] = Hash::make($validateData['password']);
        Petugas::where('id_petugas', $p->id_petugas)->update($validateData);
        
        return redirect('/administrator/petugas')->with('success', 'Data Petugas berhasil diupdate!');
    // dd($id_petugas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_petugas)
    {
        $petugas = Petugas::findOrFail($id_petugas);

        $petugas->where('id_petugas', $petugas->id_petugas)->delete();

        return redirect('/administrator/petugas')->with('success', 'Data Petugas telah dihapus');

    }
}
