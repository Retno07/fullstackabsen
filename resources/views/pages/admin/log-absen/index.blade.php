@extends('layouts.admin')
@section('log-absen', 'active')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Log Perkuliahan</h1> --}}
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
        <h5 class="card-header">Tambah Log Perkuliahan</h5>
        <div class="card-body">
            <form method="post" action="{{ route('QRCode.generate') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Matakuliah</label>
                    <select name="id_identity_log" id='id_identity_log' required class="form-control">
                        <option value="">Pilih Matakuliah</option>
                        @foreach($logbook as $logbook)
                        <option value="{{ $logbook->id_identity }}">
                            {{ $logbook->nama_mata_kuliah }} -> Kelas {{ $logbook->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="hari_log">Tanggal</label>
                    <input type="date" class="form-control" name="hari_log" placeholder="" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form group">
                    <label for="waktu_mulai_log">Waktu Mulai</label>
                    <input type="time" class="form-control" name="waktu_mulai_log" placeholder="" value="">
                </div>
                <div class="form group">
                    <label for="waktu_selesai_log">Waktu Selesai</label>
                    <input type="time" class="form-control" name="waktu_selesai_log" placeholder="" value="">
                </div>
                <div class="form-group">
                    <label for="title">Ruang</label>
                    <select name="id_ruang_log" id='id_ruang_log' required class="form-control">
                        <option value="">Pilih Ruang</option>
                        @foreach($ruang as $ruang)
                        <option value="{{ $ruang->id_ruang }}">
                            {{ $ruang->nama_ruang }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="materi">Materi</label>
                    <input type="text" class="form-control" name="materi_log" placeholder="" value="{{ old('materi_log') }}">
                </div>
                <div class="form group">
                    <label for="metode_pbm_log">Jenis Perkuliahan</label>
                    <select class="form-control" name="metode_pbm_log" placeholder="">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="Teori">Teori</option>
                        <option value="Praktikum">Praktikum</option>
                        <option value="Teori & Praktikum">Teori & Praktikum</option>
                        <option value="UTS">UTS</option>
                        <option value="UAS">UAS</option>
                        <option value="Remidi">Remidi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pertemuan_log">Pertemuan</label>
                    <select name="pertemuan_log" id='pertemuan_log' required class="form-control">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
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
