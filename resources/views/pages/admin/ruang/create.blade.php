@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Ruang</h1> --}}
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
        <h5 class="card-header">Tambah Ruang Kuliah</h5>
        <div class="card-body">
            <form action="{{ route('ruang.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="id_ruang">Kode Ruang</label>
                    <input type="number" class="form-control" name="id_ruang" placeholder="" value="{{ old('id_ruang') }}">
                </div>
                <div class="form group">
                    <label for="nama_ruang">Nama Ruang</label>
                    <input type="text" class="form-control" name="nama_ruang" placeholder="" value="{{ old('nama_ruang') }}">
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

