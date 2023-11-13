<link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<!-- Striped Rows -->
      <div class="card">
        <center>
          <h5 class="card-header">Laporan Dat Aduan</h5>
        </center>
        <div class="table-responsive text-nowrap">
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
              @foreach ($dataa as $d)
                 <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $d->nama }}</td>
                  <td>{{ $d->tgl_pengaduan }}</td>
                  <td>
                    <img src="{{ asset('storage/' . $d->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 120px; max-width: 120px; overflow:hidden">
                  </td>
                  <td>{{ $d->isi_laporan }}</td>
                  <td>
                    @if ($d->status == NULL)
                        {{ $staatus = 'Belum Valid' }}
                    @elseif ($d->status == '0')
                        {{ $status = 'Valid' }}
                    @else
                      {{ $d->status }}
                    @endif
                  </td>
                 </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->
