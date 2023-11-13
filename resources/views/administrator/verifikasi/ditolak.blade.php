@include('layouts.header');
<!-- Striped Rows -->
<div class="card">
    <h5 class="card-header">Data Ditolak</h5>
    <div class="table-responsive text-nowrap">  
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn btn-close" data-bs-dismis="alert" aria-label="close"></button>
      </div>
    @endif
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pengadu</th>
            <th>Tanggal Pengaduan</th>
            <th>Foto Penunjang</th>
            <th>Isi Aduan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        
        <tbody class="table-border-bottom-0">
          @foreach ($pengaduans as $pengaduan)
             <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $pengaduan->nama }}</td>
              <td>{{ $pengaduan->tgl_pengaduan }}</td>
              <td>
                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" class="card-img-top mt-3">
              </td>
              <td>{{ $pengaduan->isi_laporan }}</td>
              <td>
                @if ($pengaduan->status == NULL)
                    {{ $status = 'Belum Valid' }}
                @elseif($pengaduan->status == '0')
                    {{ $status = 'Valid' }}
                @else
                    {{ $status = $pengaduan->status }}
                @endif
              </td>
              <td>
                <a href="/verifikasi/tolak/{{ $pengaduan->id_pengaduan }}" class="badge bg-danger text-decoration-none">Hapus</a>
                <a href="/verifikasi/valid" class="badge bg-warning text-decoration-none">Tanggapi</a>
              </td>
             </tr>
            
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Striped Rows -->
@include('layouts.footer');