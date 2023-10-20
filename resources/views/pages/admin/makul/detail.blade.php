@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Makul {{ $item->nama_mata_kuliah }}</h1>
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
        <div class="card-body">
            <table class="table table-bordered">
                    <tr>
                        <th width="200px">Kode Matakuliah</th>
                        <td>{{ $item->id_mata_kuliah }}</td>
                    </tr>
                    <tr>
                        <th>Nama Matakuliah</th>
                        <td>{{ $item->nama_mata_kuliah }}</td>
                    </tr>
                    <tr>
                        <th>Prodi</th>
                        <td>{{ $item->prodi->first()->nama_prodi }}</td>
                    </tr>
                    <tr>
                        <th>SKS</th>
                        <td>{{ $item->sks_mata_kuliah }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>{{ $item->semester_mata_kuliah }}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>
@endsection

