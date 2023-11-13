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
                                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 80%; max-width: 70%; overflow:hidden">
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
                    <form class="">
                        <div class="form-group row">
                            @method('put')
                            @csrf
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="form-label" for="basic-icon-default-fullname">Nama Pengadu</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname" value={{ auth()->user()->nama }} readonly />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="basic-icon-default-fullname">NIK</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="number" class="form-control" id="basic-icon-default-fullname" value="{{  $pengaduan->nik }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-company">Isi Tanggapan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <textarea name="isi_laporan" class="form-control" readonly>{{ old('isi_laporan ', $pengaduan->isi_laporan) }} </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="form-label" for="basic-icon-default-fullname">Status</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="status" value="{{ old('status', $status) }}" readonly />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Laporan</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="date" class="form-control" value="{{ $pengaduan->tgl_pengaduan }}" readonly />
                                </div>
                            </div>
                        </div>
                        <br>
                        <a href="/dashboard/aduan" class="btn btn-primary">Kembali</a>
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
                    <th>Status</th>
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
            </tbody>
        </table>
    </div>
</div>
<!--/ Bootstrap Dark Table -->


@include('layouts.footer');