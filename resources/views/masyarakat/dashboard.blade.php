@include('layouts.header');
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-12 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->nama_petugas}}{{ auth()->user()->nama  }}! 🎉</h5>
                  <h6 class="card-title text-primary"> Anda Login Sebagai 
                    @if (auth()->user()->level == '')
                        {{ 'Masyarakat' }}
                    @else
                    {{ auth()->user()->level }}
                    @endif</h6>
                  <p class="mb-4">
                    Website pengaduan masyarakat adalah platform daring yang memungkinkan masyarakat untuk melaporkan permasalahan atau kejadian tertentu kepada pihak berwenang atau lembaga yang berkompeten. 
                  </p>
                @if (auth()->user()->level == '')
                <a href="/dashboard/aduan" class="btn btn-sm btn-outline-info">Laporkan Aduan</a>
                @elseif (auth()->user()->level == 'admin' or 'petugas')
                <a href="/verifikasi-nonvalid" class="btn btn-sm btn-outline-primary">Lihat Data Aduan</a>
                @endif
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img
                    src="../assets/img/illustrations/man-with-laptop-light.png"
                    height="140"
                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
 
        @if(auth()->user()->level == 'admin' or auth()->user()->level == 'petugas')
        <div class="col-lg-12 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="d-block mb-1">Aduan Non Valid</span>
                  <h3 class="card-title text-nowrap mb-2">{{ $dataNonValid }}</h3>
                  {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/chart-success.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Aduan Valid</span>
                  <h3 class="card-title mb-2">{{ $valid }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Aduan Proses</span>
                  <h3 class="card-title mb-2">{{ $proses }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                </div>
              </div>
            </div>
            <div class="col-3 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                    </div>
                    
                  </div>
                  <span class="fw-semibold d-block mb-1">Aduan Selesai</span>
                  <h3 class="card-title mb-2">{{ $selesai }}</h3>
                  {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-4 order-1">
                <div class="row">
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="d-block mb-1">Aduan Ditolak</span>
                        <h3 class="card-title text-nowrap mb-2">{{ $ditolak }}</h3>
                        {{-- <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small> --}}
                      </div>
                    </div>
                  </div>
                  @elseif(auth()->user()->nik)
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Jumlah aduan anda</span>
                        <h3 class="card-title mb-2">{{ $aduanjmlh }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Aduan Non Valid</span>
                        <h3 class="card-title mb-2">{{ $m_nonvalid }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Aduan Valid</span>
                        <h3 class="card-title mb-2">{{ $m_valid }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Aduan Proses</span>
                        <h3 class="card-title mb-2">{{ $m_proses }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Aduan Selesai</span>
                        <h3 class="card-title mb-2">{{ $m_selesai }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>    
                  <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                          <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/cc-warning.png" alt="Credit Card" class="rounded" />
                          </div>
                          
                        </div>
                        <span class="fw-semibold d-block mb-1">Aduan Ditolak</span>
                        <h3 class="card-title mb-2">{{ $m_ditolak }}</h3>
                        {{-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small> --}}
                      </div>
                    </div>
                  </div>
                  @endif
            <!-- </div>
<div class="row"> -->
          
@include('layouts.footer');