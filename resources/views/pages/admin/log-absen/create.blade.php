@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Presensi</h1> --}}
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
        <h5 class="card-header">Tambah Presensi</h5>
        <div class="card-body">
            <form action="{{ route('log-absen.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Mahasiswa</label>
                    <select name="nim_mahasiswa_absen" id="nim_mahasiswa_absen" required class="form-control">
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mhs as $mhs)
                        <option value="{{ $mhs->nim_mahasiswa }}">
                            {{ $mhs->nama_mahasiswa }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="keterangan_log_absen">Keterangan</label>
                    <select class="form-control" name="keterangan_log_absen" placeholder="keterangan">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="2">Ijin</option>
                        <option value="3">Sakit</option>
                    </select>
                </div>
                <div class="form group" hidden>
                    <label for="id_log_absen">Id Log</label>
                    <input type="text" class="form-control" name="id_log_absen" placeholder="" value="{{ $id_log_absen }}">
                </div>
                <div class="form group" hidden>
                    <label for="pertemuan_log_absen">Pertemuan Log</label>
                    <input type="text" class="form-control" name="pertemuan_log_absen" placeholder="" value="{{ $pertemuan_log }}">
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nim_mahasiswa_absen').select2({
            theme: 'bootstrap4',
        });
    });
</script>
@endsection
