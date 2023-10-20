@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Kelas</h1> --}}
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
        <h5 class="card-header">Tambah Kelas</h5>
        <div class="card-body">
            <form action="{{ route('kode-kelas.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="kode_kelas">Kode Kelas</label>
                    <input type="text" class="form-control" name="kode_kelas" placeholder="" value="{{ old('kode_kelas') }}">
                </div>
                <div class="form group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" name="nama_kelas" placeholder="" value="{{ old('nama_kelas') }}">
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

