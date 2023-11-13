@include('layouts.header');
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data</span> Tanggapan</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Foto Aduan</h5>
                </div>
                <div class="card-body">
                    <!-- Bootstrap Dark Table -->
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <td>
                                        <center>                                        
                                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 80%; max-width: 45%; overflow:hidden">
                                        </center>
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/ Bootstrap Dark Table -->
                </div>
            </div>
        </div>
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Data Pengaduan</h5>
                </div>
                <div class="card-body">
                    <form class="" method="post" action="/validasi/tanggapan/{{ $pengaduan->id_pengaduan }}">
                        <div class="form-group row">
                            {{-- @method('put') --}}
                            @csrf
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Isi Tanggapan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <textarea name="tanggapan" class="form-control @error('tanggapan') is-invalid @enderror"> </textarea>
                                @error('tanggapan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <a href="/validasi-proses" class="btn btn-warning mb-2">Kembali</a>
                        <button class="btn btn-primary" type="submit" name="submit">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->

<!-- Bootstrap Dark Table -->
<div class="card">
    <h5 class="card-header">Data Admin</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Tanggapan</th>
                    <th>Tanggapan</th>
                    <th>Nama Penanggap</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
               @foreach ($tanggapans as $data) 
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tgl_tanggapan }}</td>
                            <td>{{ $data->tanggapan }}</td>
                            <td>{{ $data->nama_petugas }}</td>
                        </tr>
                
            </tbody>
            @endforeach
        </table>
    </div>
</div>
<!--/ Bootstrap Dark Table -->
@include('layouts.footer');