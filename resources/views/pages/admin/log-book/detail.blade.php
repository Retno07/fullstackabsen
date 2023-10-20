@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Detail Log Book</h1> --}}
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow">
        <h5 class="card-header">Detail Log Book</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200px">Nama Dosen</th>
                    <td>{{ $items->users->first()->name }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>{{ $items->kelas->first()->nama_kelas }}</td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <td>
                        @foreach ($prodis as $item)
                        @if ($item->id_prodi_identity != NULL)
                        @for ($i=0;$i<$prod['prodi'];$i++) <li class="text-md-left">
                            {{get_valueProdi('prodi',($item->allprodi)[$i],'nama_prodi')}}
                            </li>
                            @endfor
                            @endif
                            @endforeach
                    </td>
                </tr>
                {{-- <tr>
                        <th>Matakuliah</th>
                        <td>
                        @foreach ($datas as $item)
                            @if ($item->id_makul_identity != NULL)
                                @for ($i=0;$i<$num['resep'];$i++)
                                    <li class="text-md-left">
                                        {{get_valueMakul('mata_kuliah',($item->allresep)[$i],'nama_mata_kuliah')}},
                {{get_valueMakul('mata_kuliah',($item->allresep)[$i],'sks_mata_kuliah')}} SKS, Semester
                {{get_valueMakul('mata_kuliah',($item->allresep)[$i],'semester_mata_kuliah')}}
                </li>
                @endfor
                @endif
                @endforeach
                </td>
                </tr> --}}
                <tr>
                    <th>Matakuliah</th>
                    <td>{{ $items->makul->first()->nama_mata_kuliah }}</td>
                </tr>
                <tr>
                    <th>SKS</th>
                    <td>{{ $items->makul->first()->sks_mata_kuliah }}</td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td>{{ $items->makul->first()->semester_mata_kuliah }}</td>
                </tr>
                <tr>
                    <th>Jumlah Mahasiswa</th>
                    <td>{{ $items->jml_mhs }}</td>
                </tr>
                <tr>
                    <th>Tahun Akademik</th>
                    <td>{{ $items->akademik->first()->tahun_akademik }} - {{ $items->akademik->first()->nama_semester_akademik }}</td>
                </tr>
            </table>
        </div>
    </div>
<br>
    <div class="card shadow">
        <h5 class="card-header">Log Book</h5>
        <div class="card-body">
            {{-- <h1 class="h3 mb-0 text-gray-800">Log Book</h1> --}}
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search" name="search" Placeholder="Minggu Ke">
                        </div>
                        <button type="submit" class="btn btn-secondary mb-2 mx-sm-3">Cari</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Minggu Ke</th>
                            <th>Ruang</th>
                            <th>Hari</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Materi</th>
                            <th>Metode</th>
                            <th>Jumlah Mahasiswa Hadir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->pertemuan_log }}</td>
                            <td>{{ $log->nama_ruang }}</td>
                            <td>{{ $log->hari_log }}</td>
                            <td>{{ $log->waktu_mulai_log }}</td>
                            <td>{{ $log->waktu_selesai_log }}</td>
                            <td>{{ $log->materi_log }}</td>
                            <td>{{ $log->metode_pbm_log }}</td>
                            <td>{{ $log->jumlah_mhs_hadir_log }}/{{ $log->jml_mhs }}</td>
                            <th width="120px">
                                <a href="{{ route('lihat_absen_detail', $log->id_log) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-sticky-note"></i>
                                    <span class="text">Presensi</span>
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
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="card shadow">
        <h5 class="card-header">Mahasiswa</h5>
        <div class="card-body">
            {{-- <h1 class="h3 mb-0 text-gray-800">Mahasiswa</h1> --}}
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search2" name="search2" Placeholder="Mahasiswa">
                        </div>
                        <button type="submit" class="btn btn-secondary mb-2 mx-sm-3">Cari</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="120px">No</th>
                            <th>Nama Mahasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mhs as $mhs)
                        <tr>
                            <td>{{ ++$start }}</td>
                            <td>{{ $mhs->nama_mahasiswa }}</td>
                            {{-- <th width="120px">
                                    <a href="{{ route('lihat_absen_detail', $log->id_log) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-sticky-note"></i>
                            <span class="text">Presensi</span>
                            </a>
                            </th> --}}
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
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
