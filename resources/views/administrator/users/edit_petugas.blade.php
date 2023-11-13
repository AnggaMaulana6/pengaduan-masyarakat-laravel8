@include('layouts.header')
<div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Edit Data Petugas</h5>
      <div class="card-body">
      <form action="/administrator/petugas/{{ $petugas->id_petugas }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" value="id_petugas">
          <div class="form-floating mb-4">
            <input
              type="text"
              name="nama_petugas"
              class="form-control @error('nama_petugas') is-invalid @enderror"
              id="floatingInput"
              placeholder="nama_petugas"
              aria-describedby="floatingInputHelp"
              required  
              value="{{ old('nama_petugas', $petugas->nama_petugas) }}"
            />
            @error('nama_petugas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Nama Petugas</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="email"
              name="email"
              class="form-control @error('email') is-invalid @enderror"
              id="floatingInput"
              placeholder="email"
              aria-describedby="floatingInputHelp"
              required  
              value="{{ old('email', $petugas->email) }}"
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="text"
              name="username"
              class="form-control @error('username') is-invalid @enderror"
              id="floatingInput"
              placeholder="username"
              aria-describedby="floatingInputHelp"
              required  
              value="{{ old('username', $petugas->username) }}"
            />
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="password"
              name="password"
              class="form-control @error('password') is-invalid @enderror"
              id="floatingInput"
              placeholder="nama"
              aria-describedby="floatingInputHelp"
              required  
              value="{{ old('password', $petugas->password) }}"
            />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">Password</label>
          </div>
          <div class="form-floating mb-4">
            <input
              type="number"
              name="telp"
              class="form-control @error('telp') is-invalid @enderror"
              id="floatingInput"
              placeholder="telp"
              aria-describedby="floatingInputHelp"
              required  
              value="{{ old('telp', $petugas->telp) }}"
            />
            @error('telp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label for="floatingInput">No Telepon</label>
        </div>
          <div class="text-center mt-4">
            <button type="submit" name="submit" value="Simpan" class="btn btn-primary">Simpan</button>
            <a href="/administrator/petugas" class="btn btn-info">Kembali</a>
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