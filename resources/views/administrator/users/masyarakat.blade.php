@include('layouts.header');
<!-- Striped Rows -->
<div class="card">
    <h5 class="card-header">Data Masyarakat</h5>
    <div class="table-responsive text-nowrap">  
        <a href="/administrator/masyarakat/create" class="btn btn-primary">Tambah Aduan</a>
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
            <th>NIK</th>
            <th>Nama Masyarakat</th>
            <th>Username</th>
            <th>Password</th>
            <th>No Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        
        <tbody class="table-border-bottom-0">
          @foreach ($masyarakats as $data)
             <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nik }}</td>
              <td>{{ $data->nama }}</td>
              {{-- <td>
                <img src="{{ asset('storage/' . $data->foto) }}" alt="" class="card-img-top mt-3" style="max-height: 120px; max-width: 120px; overflow:hidden">
              </td> --}}
              <td>{{ $data->username }}</td>
              <td>
               {{ $data->password }}
              </td>
              <td>{{ $data->telp }}</td>
              <td>
                <a href="/administrator/masyarakat/{{ $data->nik }}/edit" class="badge bg-success text-decoration-none">Edit</a>
                <form action="/administrator/masyarakat/{{ $data->nik }}" method="post" class="d-inline">
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
@include('layouts.footer');