@include('layouts.header')
<div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Edit Aduan</h5>
      <div class="card-body">
      <form action="/dashboard/aduan/{{ $pengaduan->id_pengaduan }}" method="post" enctype="multipart/form-data">
        @method('put')
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
              value="{{ old('tgl_pengaduan', $pengaduan->tgl_pengaduan) }}"
            />
            @error('tgl_pengaduan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <label for="floatingInput">Tanggal Aduan</label>
          </div>
      {{-- <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()"> --}}
      <div class="form-floating mb-4">
        <input type="hidden" name="oldFoto" value="{{ old('foto', $pengaduan->foto) }}">
        @if ($pengaduan->foto)
              <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
              <img class="img-preview img-fluid mb-3 col-sm-5">
              @endif
              <input
              type="file"
              name="foto"
              class="form-control @error('foto') is-invalid @enderror"
              id="foto"
              placeholder=""
              aria-describedby="floatingInputHelp"
              required
              onchange="previewFoto()"
              />
              @error('foto')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
              {{-- <label for="">Foto</label> --}}
            </div>
          <input type="hidden" name="status" value="{{ old('status', $pengaduan->status) }}">

          <div class="form-floating mb-4">
            <textarea name="isi_laporan" id="floatingInput" class="form-control @error('isi_laporan') is-invalid @enderror" aria-describedby="floatingInputHelp" placeholder="....">{{ $pengaduan->isi_laporan }}</textarea>
            @error('isi_laporan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <label for="floatingInput">Isi Laporan</label>
          </div>
          <input type="hidden" value="0" name="status"> 
          <div class="text-center">
            <button type="submit" name="submit" value="Simpan" class="btn btn-primary">Simpan</button>
            <a href="/dashboard/aduan" class="btn btn-info">Kembali</a>
          </div>
        </form>
      </div>
    </div>
</div>
@include('layouts.footer')

<script>
  function previewFoto(){
    const foto = document.querySelector('#foto');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(foto.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>