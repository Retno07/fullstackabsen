@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Log Presensi Mahasiswa</h1> --}}
    </div>

    <div class="card shadow">
        <h5 class="card-header">Log Presensi Mahasiswa</h5>
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search" name="search" Placeholder="Mahasiswa">
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nim_mahasiswa_absen }}</td>
                            <td>{{ $item->nama_mahasiswa }}</td>
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
