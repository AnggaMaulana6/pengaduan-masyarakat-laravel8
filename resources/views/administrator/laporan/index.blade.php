@include('layouts.header')
      <!-- Striped Rows -->
      <div class="card">
        <h5 class="card-header">Data Aduan</h5>
        <div class="table-responsive text-nowrap">
          <a href="/laporan/cetak" class="btn btn-primary">Cetak Laporan Aduan</a>
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
                <th>Nama Pengadu</th>
                <th>Tanggal Pengaduan</th>
                <th>Foto</th>
                <th>Isi Aduan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($laporans as $data)
                 <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->tgl_pengaduan }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $data->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 120px; max-width: 120px; overflow:hidden">
                  </td>
                  <td>{{ $data->isi_laporan }}</td>
                  <td>
                    @if ($data->status == NULL)
                        {{ $staatus = 'Belum Valid' }}
                    @elseif ($data->status == '0')
                        {{ $status = 'Valid' }}
                    @else
                      {{ $data->status }}
                    @endif
                  </td>
                 </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->
@include('layouts.footer')