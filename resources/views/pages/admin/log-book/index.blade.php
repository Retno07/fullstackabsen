@extends('layouts.admin')
@section('log-book', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        @if (auth()->user()->roles== 1)
        <a href="{{ route('log-book.create') }}" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Log Book
        </a>
        @endif
    </div>

    <div class="card shadow">
        <h5 class="card-header">Log Book</h5>
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
                            <th>Dosen Pengampu</th>
                            <th>Program Studi</th>
                            <th>Matakuliah</th>
                            <th>Kelas</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Tahun Akademik</th>
                            <th>Cetak</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td> {{ ++$i }} </td>
                            <td>{{ $item->name }}</td>
                            <td width="200px">
                                @if ($item->id_prodi_identity != NULL)
                                @for ($i=0;$i<sizeof($id_prodi_identity=encode($item->id_prodi_identity));$i++)
                                    <li>
                                        {{ get_valueProdi('prodi',$id_prodi_identity[$i],'nama_prodi')}}
                                    </li>
                                    @endfor
                                    @endif
                            </td>
                            {{-- <td width="200px">
                                    @if ($item->id_makul_identity != NULL)
                                    @for ($i=0;$i<sizeof($id_makul_identity=encode($item->id_makul_identity));$i++)
                                            <li>
                                                {{ get_valueMakul('mata_kuliah',$id_makul_identity[$i],'nama_mata_kuliah')}}
                            </li>
                            @endfor
                            @endif
                            </td> --}}
                            <td>{{ $item->nama_mata_kuliah }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td width="50">{{ $item->jml_mhs }}</td>
                            <td>{{ $item->tahun_akademik }} - {{ $item->nama_semester_akademik }}</td>
                            <th width="100px">
                                <a href="{{ route('cetak-logbook', $item->id_identity) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fa fa-server"></i>
                                    <span class="text">Logbook</span>
                                </a>
                                <a href="{{ route('cetak-rekap-absen', $item->id_identity) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                    <span class="text">Rekap Presensi</span>
                                </a>
                            </th>
                            <th width="100px">
                                <a href="{{ route('log-book.show', $item->id_identity) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span class="text">Lihat</span>
                                </a>
                                @if (auth()->user()->roles== 1)
                                <form action="{{ route('log-book.destroy', $item->id_identity) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </th>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
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