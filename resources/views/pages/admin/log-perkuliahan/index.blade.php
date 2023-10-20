@extends('layouts.admin')
@section('log-perkuliahan', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Log Book Dosen</h1> --}}
    </div>

    <div class="card shadow">
        <h5 class="card-header">Log Book Dosen</h5>
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="log-perkuliahan" method="GET" class="form-inline">
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
                            <th>Pertemuan</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                            <th>Ruang</th>
                            <th>Materi</th>
                            <th>Jenis Perkuliahan</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nama_mata_kuliah }}</td>
                            <td>{{ $item->pertemuan_log }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>{{ $item->hari_log }}</td>
                            <td>{{ $item->waktu_mulai_log }}</td>
                            <td>{{ $item->waktu_selesai_log }}</td>
                            <td>{{ $item->nama_ruang }}</td>
                            <td>{{ $item->materi_log }}</td>
                            <td>{{ $item->metode_pbm_log }}</td>
                            <td>{{ $item->jumlah_mhs_hadir_log }}</td>
                            <th width="100px">
                                @if ($item->jumlah_mhs_hadir_log == 0)
                                <a href="{{ route('log-perkuliahan.edit', $item->id_log) }}" class="btn btn-info">
                                    <i class="fa fa-qrcode"></i>
                                    <span class="text">Qr</span>
                                </a>
                                @endif
                                @if ($item->jumlah_mhs_hadir_log == 0)
                                <a href="{{ route('lihat_absen', $item->id_log) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span class="text">Presensi</span>
                                </a>
                                @else
                                <a href="{{ route('lihat_absen_detail', $item->id_log) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span class="text">Presensi</span>
                                </a>
                                @endif
                                <form action="{{ route('log-perkuliahan.destroy', $item->id_log) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </th>
                            <td>
                                @if($item->log_is_verif == 0)
                                Belum Diverifikasi
                                @else
                                Diverifikasi
                                @endif
                            </td>
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

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection