<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    //     $pengaduan = Pengaduan::orderBy('id_pengaduan', 'asc')->get();
    //    return view('masyarakat.aduan', [
    //     'pengaduans' => $pengaduan
    // ]);

        return view('masyarakat.aduan',[
            'title' => 'Tulis Aduan',
            'pengaduans' => Pengaduan::where('nik', auth()->user()->nik)->get() 
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masyarakat.pengaduan.tambah', [
            'title' => 'Tambah Aduan',
            // 'nik' => Masyarakat::all()
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePengaduanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tgl_pengaduan' => 'required',
            'foto' => 'required|image|max:1024',
            'isi_laporan' => 'required',
            // 'status' => 'NULL'
        ]);
    
        if($request->file('foto')){
            $validateData['foto'] = $request->file('foto')->store('foto-aduan');
        }

        $validateData['nik'] = auth()->user()->nik;

        Pengaduan::create($validateData);

        return redirect('/dashboard/aduan')->with('success', 'Aduan ditambahkan');
    // dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function show($id_pengaduan)
    {
        // return view('masyarakat.pengaduan.show', [
        //     'pengaduan' => $pengaduan
        // ]);
        
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        if($pengaduan->status == NULL){
            $status = 'Non Valid';
        }elseif($pengaduan->status == '0'){
            $status = 'Valid';
        }else{
            $status = $pengaduan->status;
        }
        return view('masyarakat.pengaduan.show',[
            'title' => 'Lihat Data Aduan'
        ], compact('pengaduan', 'status'));
    
        // dd($id_pengaduan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        if($pengaduan->status == NULL){
            $status = 'Non Valid';
        }elseif($pengaduan->status == '0'){
            $status = 'Valid';
        }else{
            $status = $pengaduan->status;
        }
        return view('masyarakat.pengaduan.edit',[
            'title' => 'Edit Pengaduan',
        ], compact('pengaduan', 'status'));
        
        // dd($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePengaduanRequest  $request
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,  $id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $rules = [
            'tgl_pengaduan' => 'required',
            'foto' => 'required|image|file|max:1024',
            'isi_laporan' => 'required',
            'status' => 'required'
        ];

        $validateData = $request->validate($rules);

        if($request->file('foto')){
            if($request->oldFoto){
                Storage::delete($request->oldFoto);
            }
            $validateData['foto'] = $request->file('foto')->store('foto-aduan');
        }

        $validateData['nik'] = auth()->user()->nik;

        Pengaduan::where('id_pengaduan', $pengaduan->id_pengaduan)
                ->update($validateData);
        
        return redirect('/dashboard/aduan')->with('success', 'Aduan berhasil diupdate');
        // dd($pengaduan, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengaduan  $pengaduan
     * @return Response
     */
    public function destroy($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        if($pengaduan->foto){
            Storage::delete($pengaduan->foto);
        }
        // Pengaduan::destroy($id_pengaduan->id_pengaduan);
        Pengaduan::Where('id_pengaduan', $id_pengaduan)->delete();
        // compact('status');

        return redirect('/dashboard/aduan')->with('success', 'Aduan telah dihapus');
            // dd($id_pengaduan);
    }
    public function showTang($id_pengaduan){
        $tanggapan = DB::table('pengaduans')
    ->join('tanggapans', 'pengaduans.id_pengaduan', '=', 'tanggapans.id_pengaduan')
    ->join('petugas', 'tanggapans.id_petugas', '=', 'petugas.id_petugas')
    ->select('pengaduans.*', 'tanggapans.tanggapan', 'petugas.nama_petugas')
    ->where('pengaduans.id_pengaduan', $id_pengaduan)
    ->get();


        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        if($pengaduan->status == NULL){
            $status = 'Non Valid';
        }elseif($pengaduan->status == '0'){
            $status = 'Valid';
        }else{
            $status = $pengaduan->status;
        }
        return view('masyarakat.pengaduan.lihat_tanggapan',[
            'title' => 'Lihat Tanggapan',
        ], compact('pengaduan', 'status', 'tanggapan'), $tanggapan);
    }
}
