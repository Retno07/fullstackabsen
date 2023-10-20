@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Log Book</h1> --}}
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
        <h5 class="card-header">Log Book</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="200px">NIM</th>
                    <td>{{ $mhs->nim_mahasiswa }}</td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $mhs->nama_mahasiswa }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $mhs->email_mahasiswa }}</td>
                </tr>
            </table>
        </div>
    </div>
<br>
    <div class="card shadow">
        <div class="card-body">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="search" name="search" Placeholder="Matakuliah">
                        </div>
                        <button type="submit" class="btn btn-secondary mb-2 mx-sm-3">Cari</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dosen Pengajar</th>
                            <th>Prodi</th>
                            <th>Matakuliah</th>
                            <th>Kelas</th>
                            <th>Akademik</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td> {{ ++$i }} </td>
                            <td>{{ $item->name }}</td>
                            <td width="200px">
                                @if ($item->id_prodi_identity != NULL)
                                @for ($i=0;$i<sizeof($id_prodi_identity=encode($item->id_prodi_identity));$i++)
                                    <li>
                                        {{ get_valueProdi('prodi',$id_prodi_identity[$i],'nama_prodi')}}
                                    </li>
                                    @endfor
                                    @endif
                            </td>
                            {{-- <td width="200px">
                                    @if ($item->id_makul_identity != NULL)
                                    @for ($i=0;$i<sizeof($id_makul_identity=encode($item->id_makul_identity));$i++)
                                            <li>
                                                {{ get_valueMakul('mata_kuliah',$id_makul_identity[$i],'nama_mata_kuliah')}}
                            </li>
                            @endfor
                            @endif
                            </td> --}}
                            <td>{{ $item->nama_mata_kuliah }}</td>
                            <td>{{ $item->nama_kelas }}</td>
                            <td>{{ $item->tahun_akademik }} - {{ $item->nama_semester_akademik }}</td>
                            <th width="120px">
                                <a href="{{ route('detail_kelas_log', [$item->id_identity, $item->nim_mahasiswa_absen]) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-eye"></i>
                                    <span class="text">Lihat Kehadiran</span>
                                </a>
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
@endsection
