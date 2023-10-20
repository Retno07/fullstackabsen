@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Buat Log Book</h1> --}}
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
        <h5 class="card-header">Buat Log Book</h5>
        <div class="card-body">
            <form action="{{ route('log-book.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Program Studi</label>
                    <select name="id_prodi_identity" id='id_prodi_identity' required class="form-control font-weight-light">
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodi as $prodi)
                        <option value="{{ $prodi->id_prodi }}">
                            {{ $prodi->nama_prodi }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label for="title">Matakuliah</label>
                    <select name="id_makul_identity" required class="form-control" id="id_makul_identity">
                        <option value="">Pilih Matakuliah</option>

                        </option>
                    </select>
                </div>  --}}

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="id_makul_identity">Matakuliah</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 mb-0 mb-sm-0">
                        <select class="form-control font-weight-light" name="id_makul_identity" id="id_makul_identity">
                            <option value="" selected disabled>Pilih Matakuliah</option>
                            {{-- @foreach ($obats as $obat)
                                <option value="{{$obat->id}}">{{$obat->nama_obat}} {{$obat->sediaan}} {{$obat->dosis}}{{$obat->satuan}}</option>
                            @endforeach --}}
                        </select>
                        <small id="makulHelp" class="text-danger">
                            Setelah pilih Matakuliah klik tombol TAMBAHKAN.
                        </small>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <a href="javascript:;" onclick="addmakul()" type="button" name="addmakul" id="addmakul" class="btn btn-primary btn-block">Tambahkan</a>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 mb-0 mb-sm-0">
                        <table width="100%" id="tabel_makul"></table>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Dosen Pengajar</label>
                    <select name="id_dosen_identity" id="id_dosen_identity" required class="form-control font-weight-light">
                        <option value="">Pilih Dosen Pengajar</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Kelas</label>
                    <select name="id_kelas_identity" id="id_kelas_identity" required class="form-control font-weight-light">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $kelas)
                        <option value="{{ $kelas->id_kelas }}">
                            {{ $kelas->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form group">
                    <label for="jml_mhs">Jumlah Mahasiswa</label>
                    <input type="number" class="form-control" name="jml_mhs" placeholder="" value="{{ old('jml_mhs') }}">
                </div>
                <div class="form-group">
                    <label for="title">Tahun Akademik</label>
                    <select name="id_akademik_identity" required class="form-control font-weight-light">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach($tahun as $tahun)
                        <option value="{{ $tahun->id_akademik }}">
                            {{ $tahun->tahun_akademik }} / {{ $tahun->nama_semester_akademik }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="id_mhs_identity">Mahasiswa</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9 mb-0 mb-sm-0">
                        <select class="form-control" name="id_mhs_identity" id="id_mhs_identity">
                            <option value="" selected disabled>Pilih Mahasiswa</option>
                            @foreach($mhs as $mhs)
                                <option value="{{$mhs->nim_mahasiswa}}">{{$mhs->nama_mahasiswa}}</option>
                @endforeach
                </select>
        </div>
        <div class="col-sm-3 mb-3">
            <a href="javascript:;" onclick="addmhs()" type="button" name="addmhs" id="addmhs" class="btn btn-primary btn-block">Tambahkan</a>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-0 mb-sm-0">
            <table width="100%" id="tabel_mhs"></table>
        </div>
    </div> --}}

    <div class="form-group row">
        <div class="col-sm-6">
            <label for="id_mhs_identity">Mahasiswa</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-9 mb-0 mb-sm-0">
            <select class="form-control font-weight-light" name="inputs[1][id_mhs_identity]" id="id_mhs_identity">
                <option value="" selected disabled>Pilih Mahasiswa</option>
                @foreach($mhs as $mhs)
                <option value="{{$mhs->nim_mahasiswa}}">{{$mhs->nama_mahasiswa}}</option>
                @endforeach
            </select>
            <small id="makulHelp" class="text-danger">
                Setelah pilih Mahasiswa klik tombol TAMBAHKAN.
            </small>
        </div>
        <div class="col-sm-3 mb-3">
            <a href="javascript:;" onclick="add()" type="button" name="add" id="add" class="btn btn-primary btn-block">Tambahkan</a>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12 mb-0 mb-sm-0">
            <table width="100%" id="tabel_mhs"></table>
        </div>
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
        $('#id_makul_identity').select2({
            theme: 'bootstrap4',
        });
        $('#id_dosen_identity').select2({
            theme: 'bootstrap4',
        });
        $('#id_mhs_identity').select2({
            theme: 'bootstrap4',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#id_prodi_identity').on('change', function() {
            var id_prodi = this.value;
            $("#id_makul_identity").html('');
            $.ajax({
                url: "{{ route('getMakul') }}",
                type: "POST",
                data: {
                    id_prodi: id_prodi,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#id_makul_identity').html('<option value="">Pilih Matakuliah</option>');
                    $.each(result.mata_kuliah, function(key, value) {
                        $("#id_makul_identity").append('<option value="' + value
                            .id_mata_kuliah + '">' + "(" + value.id_mata_kuliah + ")" + value.nama_mata_kuliah + '</option>');
                    });
                }
            });
        });
    });
</script>
<script type="text/javascript">
    var i = 0;
    var a = 0;

    function addmakul() {
        var res = $("#id_makul_identity option:selected").html();
        var resid = $("#id_makul_identity").val();
        var residprodi = $("#id_prodi_identity").val();
        if (resid !== null) {
            //code
            $("#tabel_makul").append('<tr><td><input type="hidden" name="makul[' + a + '][id_makul_identity]" value="' + resid + '" class="form-control" readonly></td><td><input type="text" name="makul[' + a + '][nama_mata_kuliah]" value="' + res + '" class="form-control" readonly></td><td><input type="hidden" name="makul[' + a + '][id_prodi_identity]" value="' + residprodi + '" class="form-control" readonly></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };

    $(document).on('click', '.remove-res', function() {
        $(this).parents('tr').remove();
    });
</script>
<script type="text/javascript">
    var i = 0;
    var a = 0;

    function addmhs() {
        var res = $("#id_mhs_identity option:selected").html();
        var resid = $("#id_mhs_identity").val();
        if (resid !== null) {
            //code
            $("#tabel_mhs").append('<tr><td><input type="hidden" name="mahasiswa[' + a + '][id_mhs_identity]" value="' + resid + '" class="form-control" readonly></td><td><input type="text" name="mahasiswa[' + a + '][nama_mahasiswa]" value="' + "(" + '' + resid + '' + ")" + ' ' + res + '" class="form-control" readonly></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };
</script>
<script type="text/javascript">
    var i = 0;
    var a = 0;

    function add() {
        var res = $("#id_mhs_identity option:selected").html();
        var resid = $("#id_mhs_identity").val();
        if (resid !== null) {
            //code
            $("#tabel_mhs").append('<tr>/<td><input type="hidden" name="inputs[' + a + '][id_mhs_identity]" value="' + resid + '" class="form-control" readonly></td><td><input type="text" name="inputs[' + a + '][nama_mahasiswa]" value="' + "(" + '' + resid + '' + ")" + ' ' + res + '" class="form-control" readonly></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></tr>');
        }
        ++a;
    };
</script>
@endsection
