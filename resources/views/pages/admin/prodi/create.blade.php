@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Data Prodi</h1> --}}
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
        <h5 class="card-header"> Tambah Data Prodi</h5>
        <div class="card-body">
            <form action="{{ route('prodi.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="id_prodi">Kode Prodi</label>
                    <input type="number" class="form-control" name="id_prodi" placeholder="" value="{{ old('id_prodi') }}">
                </div>
                <div class="form group">
                    <label for="nama_prodi">Nama Prodi</label>
                    <input type="text" class="form-control" name="nama_prodi" placeholder="" value="{{ old('nama_prodi') }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

