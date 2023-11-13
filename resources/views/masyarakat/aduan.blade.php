@include('layouts.header')
      <!-- Striped Rows -->
      <div class="card">
        <h5 class="card-header">Data Aduan</h5>
        <div class="table-responsive text-nowrap">
          <a href="/dashboard/aduan/create" class="btn btn-primary">Tambah Aduan</a>
        <hr>  
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
                <th>Tanggal Pengaduan</th>
                <th>Foto</th>
                <th>Isi Aduan</th>
                <th>Status</th>
                <th>Tanggapan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($pengaduans as $pengaduan)
                 <tr>
                  <td>{{ $pengaduan->id_pengaduan }}</td>
                  <td>{{ $pengaduan->tgl_pengaduan }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 120px; max-width: 120px; overflow:hidden">
                  </td>
                  <td>{{ $pengaduan->isi_laporan }}</td>
                  <td>
                    {{ $pengaduan->status }}
                  </td>
                  <td>
                    @if($pengaduan['status'] == 'proses' or $pengaduan['status'] == '0')
                      <a href="/lihat-tanggapan/{{ $pengaduan->id_pengaduan }}/edit" class='btn btn-warning btn-sm'>Lihat Tanggapan</a>
                  @elseif($pengaduan['status'] =='ditolak') 
                      <div class="btn btn-danger btn sm">Aduan Ditolak</div>
                  @elseif($pengaduan['status'] =='selesai')
                      <div class="btn btn-info btn sm">Aduan Telah Selesai</div>
                  @else
                      <div class="btn btn-secondary btn sm">Belum ditanggapi</div>
                  @endif
                    </td>
                  <td>
                    <a href="/dashboard/aduan/{{ $pengaduan->id_pengaduan }}" class="badge bg-info text-decoration-none">Lihat</a>
                    <a href="/dashboard/aduan/{{ $pengaduan->id_pengaduan }}/edit" class="badge bg-warning text-decoration-none">Edit</a>
                  <form action="/dashboard/aduan/{{ $pengaduan->id_pengaduan }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" type="submit" onclick="return confirm('Kamu yakin ingin menghapus data?')">Hapus</button>
                  </form>
                  </td>
                 </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->
@include('layouts.footer')