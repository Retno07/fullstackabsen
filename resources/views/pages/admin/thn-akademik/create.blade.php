@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Tahun Akademik</h1> --}}
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
        <h5 class="card-header">Tambah Tahun Akademik</h5>
        <div class="card-body">
            <form action="{{ route('thn-akademik.store') }}" method="POST">
                @csrf
                <div class="form group">
                    <label for="tahun_akademik">Tahun</label>
                    <input type="text" class="form-control" name="tahun_akademik" placeholder="" value="{{ old('tahun_akademik') }}">
                </div>
                <div class="form group">
                    <label for="nama_semester_akademik">Semester</label>
                    <select class="form-control" name="nama_semester_akademik" placeholder="Semester">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="GANJIL">GANJIL</option>
                        <option value="GENAP">GENAP</option>
                    </select>
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

