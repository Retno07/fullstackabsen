@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Log Presensi Mahasiswa</h1> --}}
    </div>

    <div class="card shadow">
        <h5 class="card-header">Log Absen Mahasiswa</h5>
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="{{ route('verif_jml_mhs') }}" method="GET" class="form-inline">
                        {{-- <form action="" method="GET" class="form-inline">  --}}
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" name="jumlah_mhs_hadir_log" value="{{ $jumlah_mhs }}" readonly>
                        </div>
                        @foreach($items as $item)
                        <div hidden class="col-sm-3">
                            <input type="text" class="form-control" name="id" value="{{ $item->id_log }}">
                        </div>
                        @endforeach
                        {{-- <button type="submit" value="simpan" class="btn btn-info mb-2 mx-sm-3"  onclick="return klik()">Verifikasi</button> --}}
                        <button type="submit" value="simpan" class="btn btn-info mb-2 mx-sm-3 show-alert-verif-box" data-toggle="tooltip" title='Verif'>Verifikasi</button>
                    </form>
                </div>
            </div>
            <div class="d-sm-flex align-items-center justify-content-between">
                <form action="" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" id="search" name="search" Placeholder="Mahasiswa">
                    </div>
                    <button type="submit" class="btn btn-secondary mb-2 mx-sm-3">Cari</button>
                </form>
                <a href="{{ route('log-absen.create') }}" class="btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Presensi
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->nim_mahasiswa_absen }}</td>
                            <td>{{ $item->nama_mahasiswa }}</td>
                            @if($item->keterangan_log_absen == 1)
                            <td>Hadir Pertemuan ke {{ $item->pertemuan_log_absen }}</td>
                            @elseif($item->keterangan_log_absen == 2)
                            <td>Ijin Pertemuan ke {{ $item->pertemuan_log_absen }}</td>
                            @elseif($item->keterangan_log_absen == 3)
                            <td>Sakit</td>
                            @endif
                            <th width="120px">
                                <form action="{{ route('log-absen.destroy', $item->id_absen) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>
                                        <i class="fa fa-trash"></i>
                                        Hapus
                                    </button>
                                </form>
                            </th>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Data Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="form-group float-right">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('.show-alert-verif-box').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Presensi yang sudah diverifikasi tidak dapat diubah. Lanjutkan ?",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel", "Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verif it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
{{-- <script type="text/javascript">
    function klik(){
    return confirm('Presensi yang sudah diverifikasi tidak dapat diubah. Lanjutkan ?');
    }
</script> --}}
@endsection
