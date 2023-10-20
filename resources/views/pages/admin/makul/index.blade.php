@extends('layouts.admin')
@section('makul', 'active')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        <a href="{{ route('makul.create') }}" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Makul
        </a>
    </div>

    <div class="card shadow">
        <h5 class="card-header">Data Makul</h5>
        <div class="card-body">
        <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                  <form action="makul" method="GET" class="form-inline">
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
                            <th>Kode</th>
                            <th>Nama Matakuliah</th>
                            <th>Prodi</th>
                            <th>Jumlah SKS</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td> {{ ++$i }} </td>
                                <td>{{ $item->id_mata_kuliah }}</td>
                                <td>{{ $item->nama_mata_kuliah}}</td>
                                <td>{{ $item->prodi->first()->nama_prodi }}</td>
                                <td>{{ $item->sks_mata_kuliah }}</td>
                                <td>{{ $item->semester_mata_kuliah }}</td>
                                <th width="100px">
                                    <a href="{{ route('makul.show', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-eye"></i>
                                        <span class="text">Lihat</span>
                                    </a>

                                    @if (auth()->user()->profesi== 'Staff')
                                    <a href="{{ route('makul.edit', $item->id) }}" class="btn btn-dark btn-sm">
                                        <i class="fa fa-pencil-alt"></i>
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="{{ route('makul.destroy', $item->id) }}" method="POST" class="d-inline">
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

