@extends('layouts.admin')
@section('mahasiswa', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Mahasiswa
        </a>
    </div>

    <div class="card shadow">
        <h5 class="card-header">Data Mahasiswa</h5>
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="mahasiswa" method="GET" class="form-inline">
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
                            <th>Prodi</th>
                            <th>Tahun Angkatan</th>
                            <th>Dosen Pembimbing Akademik</th>
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
                            <td>{{ $item->nama_prodi }}</td>
                            <td>{{ $item->tahun_masuk }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email_mahasiswa }}</td>
                            <th width="100px">
                                {{-- <a href="{{ route('pengguna.show', $item->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span class="text">Lihat</span>
                                </a> --}}
                                <a href="{{ route('mahasiswa.edit', $item->nim_mahasiswa) }}" class="btn btn-dark btn-sm">
                                    <i class="fa fa-pencil-alt"></i>
                                    <span class="text">Edit</span>
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $item->nim_mahasiswa) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
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
