@include('layouts.header')
<div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Tambah Aduan</h5>
      <div class="card-body">
      <form action="/dashboard/aduan" method="post" enctype="multipart/form-data">
        @csrf
          <div class="form-floating mb-4">
            <input
              type="date"
              name="tgl_pengaduan"
              class="form-control @error('tgl_pengaduan') is-invalid @enderror"
              id="floatingInput"
              placeholder="Tanggal"
              aria-describedby="floatingInputHelp"
              required
            />
            @error('tgl_pengaduan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Tanggal Aduan</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="file"
              name="foto"
              class="form-control @error('foto') is-invalid @enderror"
              id="floatingInput"
              placeholder=""
              aria-describedby="floatingInputHelp"
              required
            />
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Foto</label>
          </div>
          <div class="form-floating mb-4">
            <textarea name="isi_laporan" id="floatingInput" class="form-control @error('nik') is-invalid @enderror" aria-describedby="floatingInputHelp" placeholder="...." required></textarea>
            @error('isi_laporan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Isi Laporan</label>
          </div>
          {{-- <input type="hidden" value="" name="status">  --}}
          <div class="text-center">
            <button type="submit" name="submit" value="Simpan" class="btn btn-primary">Simpan</button>
            <a href="/dashboard/aduan" class="btn btn-info">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
@include('layouts.footer')