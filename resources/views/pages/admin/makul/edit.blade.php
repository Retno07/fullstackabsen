@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Edit Data Makul -> {{ $item->nama_mata_kuliah }}</h1> --}}
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
        <h5 class="card-header">Edit Data Makul</h5>
        <div class="card-body">
            <form action="{{ route('makul.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form group">
                    <label for="id_mata_kuliah">Kode Matakuliah</label>
                    <input type="text" class="form-control" name="id_mata_kuliah" placeholder="Kode Matakuliah" value="{{ $item->id_mata_kuliah }}">
                </div>

                <div class="form-group">
                    <label for="title">Prodi</label>
                    <select name="id_prodi" required class="form-control" id="id_prodi">
                        <option value="">Pilih Prodi</option>
                        @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id_prodi }}" {{ $prodi->id_prodi == $item->id_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form group">
                    <label for="nama_mata_kuliah">Nama Matakuliah</label>
                    <input type="text" class="form-control" name="nama_mata_kuliah" placeholder="Nama Matakuliah" value="{{ $item->nama_mata_kuliah }}">
                </div>
                <div class="form group">
                    <label for="sks_mata_kuliah">SKS</label>
                    <input type="text" class="form-control" name="sks_mata_kuliah" placeholder="SKS" value="{{ $item->sks_mata_kuliah }}">
                </div>
                <div class="form group">
                    <label for="semester_mata_kuliah">Semester</label>
                    <input type="text" class="form-control" name="semester_mata_kuliah" placeholder="Semester" value="{{ $item->semester_mata_kuliah }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Ubah
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

