@extends('layouts.admin')
@section('admin-kelas', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Data Kelas Mahasiswa</h1> --}}
        {{-- <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kelas Mahasiswa
        </a> --}}
    </div>

    <div class="card shadow">
        <h5 class="card-header">Data Kelas Mahasiswa</h5>
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="admin-kelas" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search" name="search" Placeholder="Nama Mahasiswa">
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
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nim_mahasiswa }}</td>
                            <td>{{ $item->nama_mahasiswa }}</td>
                            <td>{{ $item->email_mahasiswa }}</td>
                            <th width="100px">
                                <a href="{{ route('cetak-rekap-krs', $item->nim_mahasiswa) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                    <span class="text">KRS</span>
                                </a>
                                <a href="{{ route('cetak_kelas', $item->nim_mahasiswa) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span class="text">Lihat Kelas</span>
                                </a>
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
@endsection
