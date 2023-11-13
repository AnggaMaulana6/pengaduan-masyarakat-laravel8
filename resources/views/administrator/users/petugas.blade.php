@include('layouts.header');
<!-- Striped Rows -->
<div class="card">
    <h5 class="card-header">Data Petugas</h5>
    <div class="table-responsive text-nowrap">  
        <a href="/administrator/petugas/create" class="btn btn-primary">Tambah Petugas</a>
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
            <th>Nama Masyarakat</th>
            <th>Username</th>
            <th>Password</th>
            <th>No Telepon</th>
            <th>Level</th>
            <th>Aksi</th>
          </tr>
        </thead>
        
        <tbody class="table-border-bottom-0">
          @foreach ($petugass as $data)
             <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nama_petugas }}</td>
              <td>{{ $data->username }}</td>
              <td>{{ $data->password }}</td>
              <td>
               {{ $data->telp }}
              </td>
              <td>{{ $data->level }}</td>
              <td>
                <a href="/administrator/petugas/{{ $data->id_petugas }}/edit" class="badge bg-success text-decoration-none">Edit</a>
                <form action="/administrator/petugas/{{ $data->id_petugas }}" method="post" class="d-inline">
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