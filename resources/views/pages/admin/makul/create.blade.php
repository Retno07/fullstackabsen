@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Data Makul</h1> --}}
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
        <h5 class="card-header">Tambah Data Makul</h5>
        <div class="card-body">
            <form action="{{ route('makul.store') }}" method="POST">
                @csrf
                <label for="title">Program Studi</label>
                <div class="form-group row">
                    <div class="col-sm-9 mb-0 mb-sm-0">
                        <select class="form-control font-weight-light" name="id_prodi" id="id_prodi">
                            <option value="" selected disabled>Pilih Prodi</option>
                            @foreach($prodi as $prodi)
                                <option value="{{ $prodi->id_prodi }}">
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        <small id="makulHelp" class="text-danger">
                            Setelah pilih Prodi klik tombol TAMBAHKAN.
                        </small>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <a href="javascript:;" onclick="addkode()" type="button" name="addkode" id="addkode" class="btn btn-primary btn-block">Tambahkan</a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mb-0 mb-sm-0">
                        <table width="100%" id="kode_makul"></table>
                    </div>
                </div>
                <div class="form group">
                    <label for="nama_mata_kuliah">Nama Matakuliah</label>
                    <input type="text" class="form-control" name="nama_mata_kuliah" placeholder="" value="{{ old('nama_mata_kuliah') }}">
                </div>
                <div class="form group">
                    <label for="sks_mata_kuliah">Jumlah SKS</label>
                    <select class="form-control" name="sks_mata_kuliah" placeholder="Jumlah SKS">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                    </select>
                </div>
                <div class="form group">
                    <label for="semester_mata_kuliah">Semester</label>
                    <select class="form-control" name="semester_mata_kuliah" placeholder="Semester">
                        <option value="" selected disabled>Pilih..</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_prodi').select2({
            theme: 'bootstrap4',
        });
    });
</script>
<script type="text/javascript">
    var i = 0;
    var a = 0;

    function addkode() {
        var res = $("#id_prodi option:selected").html();
        var resid = $("#id_prodi").val();
        if (resid !== null) {
            //code
            $('#kode_makul').html('<label for="kode_makul">Kode Matakuliah</label>');
            $("#kode_makul").append('<tr><td><input type="number" name="id_mata_kuliah" value="' + resid + '" class="form-control"></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };

    $(document).on('click', '.remove-res', function() {
        $(this).parents('tr').remove();
    });
</script>
@endsection

