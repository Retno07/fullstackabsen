@extends('layouts.admin')
@section('dashboard', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    @if (auth()->user()->profesi=='Staff')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
    </div>
    @elseif (auth()->user()->profesi=='Dosen')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Dosen</h1>
    </div>
    @endif
    {{-- <!-- Content Row -->  --}}
    <div class="row">

        {{-- <!-- Earnings (Monthly) Card Example -->  --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Mahasiswa
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswa }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Earnings (Monthly) Card Example -->  --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Dosen
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dosen }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Earnings (Monthly) Card Example -->  --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Karyawan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $staff }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <!-- Pending Requests Card Example -->  --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Matakuliah
                            </div>
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $makul }}</div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->profesi== 'Dosen')
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Membuat Log Perkuliahan (Generate QR-Code)</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <strong>1.</strong> Buka menu <a href="{{ route('log-absen.index') }}">Presensi</a> <br>
                        <strong>2.</strong> Input data perkuliahan sesuai dengan jadwal perkuliahan <br>
                        <strong>3.</strong> Simpan <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                    <h6 class="m-0 font-weight-bold text-primary">Verifikasi Log Perkuliahan</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample2">
                    <div class="card-body">
                        Verifikasi log digunakan untuk melakukan verifikasi mahasiswa dalam proses presensi, sekaligus mengakhiri sesi perkuliahan. <br>
                        Petunjuk melakukan verifikasi tekan button <strong>Lihat</strong> pada QR atau buka menu <a href="{{ route('log-perkuliahan.index') }}">Log Perkuliahan</a> kemudian tekan button <strong>Presensi</strong> kemudian verifikasi
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (auth()->user()->roles== 1)
    <div class="card shadow">
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search" name="search" Placeholder="Matakuliah">
                        </div>
                        <button type="submit" class="btn btn-secondary mb-2 mx-sm-3">Cari</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dosen Pengajar</th>
                            <th>Matakuliah</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Ruang</th>
                            <th>Materi</th>
                            <th>Jenis Perkuliahan</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nama_mata_kuliah }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>{{ $item->hari_log }}</td>
                            <td>{{ $item->waktu_mulai_log }}</td>
                            <td>{{ $item->waktu_selesai_log }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->hari_log)) }}</td>
                            <td>{{ $item->materi_log }}</td>
                            <td>{{ $item->metode_pbm_log }}</td>
                            <td>{{ $item->jumlah_mhs_hadir_log }}</td>
                            <th width="120px">
                                <a href="{{ route('verifikasi_log', $item->id_log) }}" class="btn btn-info">
                                    <i class="fa fa-check"></i>
                                    <span class="text">Verifikasi</span>
                                </a>
                            </th>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="form-group float-right">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection