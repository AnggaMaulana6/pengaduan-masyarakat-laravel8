<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Masyarakat;
use PDF;
use DB;
use TCPDF;
class LaporanController extends Controller
{
    public function __construct(){
        $this->Pengaduan = new Pengaduan();
    }
    public function index(){
        $laporan = [
            'title' => 'Laporan Pengaduan',
            'laporans' => $this->Pengaduan->dataLaporan(),
        ];
        
        return view('administrator.laporan.index', $laporan);
    }
    public function cetakPdf(){
        $laporan = [
            'laporans' => $this->Pengaduan->dataLaporan(),
        ];
        return view('administrator.laporan.cetakPdf', $laporan);
    }
    // public function downloadPdf(){
    //     // $data = DB::table('pengaduans')
    //         // ->join('masyarakats', 'pengaduans.nik', '=', 'masyarakats.nik')
    //         // ->select('pengaduans.*', 'masyarakats.nama')
    //         // ->where('pengaduan.nik', $nik)
    //         // ->get();
    //     // $data = Pengaduan::all();

    //     $laporan = [
    //         'laporans' => $this->Pengaduan->dataLaporan(),
    //     ];
    //     $pdf = PDF::loadView('administrator.laporan.cetakPdf', $laporan);

    //     return $pdf->download('report.pdf');
    //     // dd($laporan);
    // }
    public function downloadPdf(){
         // Ambil data dari database
    $data = DB::table('pengaduans')
    ->join('masyarakats', 'pengaduans.nik', '=', 'masyarakats.nik')
    ->get();

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// Set judul laporan
$pdf->SetFont('dejavusans', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Semua Pengaduan Masyarakat', 0, 1, 'C');

// Tabel untuk data
$pdf->SetFont('dejavusans', '', 12);
$pdf->Ln(20); // Spasi
// $pdf->MultiCell(0, 10, 'Laporan Pengaduan Masyarakat:', 0, 'L');
$pdf->Ln(10);
$pdf->SetFillColor(220, 220, 220);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0);
$pdf->SetFont('helvetica', 'B');

// Header tabel
$pdf->Cell(35, 10, 'Nama Pengadu', 1, 0, 'C', 1);
$pdf->Cell(45, 10, 'Tanggal Pengaduan', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'Foto', 1, 0, 'C', 1);
$pdf->Cell(65, 10, 'Isi Aduan', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'Status', 1, 1, 'C', 1);

// Isi tabel
foreach ($data as $row) {
    $imageFile = public_path('storage/' . $row->foto);
    $pdf->Cell(35, 20, $row->nama, 1);
    $pdf->Cell(45, 20, $row->tgl_pengaduan, 1);

    // Tambahkan gambar dari database
    $pdf->Image($imageFile, $pdf->GetX(), $pdf->GetY(), 25, 20, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

    
    $pdf->Cell(65, 20, $row->isi_laporan, 1);
    if($row->status == NULL){
        $status = 'Non Valid';
    }elseif($row->status == '0'){
        $status = 'Valid';
    }else{
        $status = $row->status;
    }
    $pdf->Cell(25, 20, $status, 1, 1);
    $pdf->Ln(0); // Spasi antar data
}

$pdf->Output('Laporan Pengaduan.pdf', 'I');
    }
}