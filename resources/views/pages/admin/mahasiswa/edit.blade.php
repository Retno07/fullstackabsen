@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Edit Data Mahasiswa -> {{ $item->nama_mahasiswa }}</h1> --}}
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
        <h5 class="card-header">Edit Data Mahasiswa</h5>
        <div class="card-body">
            <div class="col-md-8">
                <form method="POST" action="{{ route('mahasiswa.update', $item->nim_mahasiswa) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <label for="nim_mahasiswa" class="col-md-3 col-form-label text-md-end">NIM</label>
                        <div class="col-md-6">
                            <input id="nim_mahasiswa" type="text" class="form-control @error('nim_mahasiswa') is-invalid @enderror" name="nim_mahasiswa" value="{{ old('nim_mahasiswa',$item->nim_mahasiswa) }}" required autocomplete="nim_mahasiswa" autofocus>
                            @error('nim_mahasiswa')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <label for="nama_mahasiswa" class="col-md-3 col-form-label text-md-end">Nama</label>
                        <div class="col-md-6">
                            <input id="nama_mahasiswa" type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" value="{{ old('nama_mahasiswa',$item->nama_mahasiswa) }}" required autocomplete="nama_mahasiswa" autofocus>
                            @error('nama_mahasiswa')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-end">Prodi</label>
                        <div class="col-md-6">
                            <select name="id_prodi" required class="form-control" id="id_prodi">
                                <option value="">Pilih Prodi</option>
                                @foreach($prodi as $prodi)
                                <option value="{{ $prodi->id_prodi }}" {{ $prodi->id_prodi == $item->id_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tahun_masuk" class="col-md-3 col-form-label text-md-end">Tahun Masuk</label>
                        <div class="col-md-6">
                            <input id="tahun_masuk" type="text" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk" value="{{ old('tahun_masuk',$item->tahun_masuk) }}" required autocomplete="nama_mahasiswa" autofocus>
                            @error('tahun_masuk')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-end">Dosen Pembimbing Akademik</label>
                        <div class="col-md-6">
                            <select name="id_dosen" required class="form-control" id="id_dosen">
                                <option value="">Pilih Dosen PA</option>
                                @foreach($user as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $item->id_dosen ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email_mahasiswa" class="col-md-3 col-form-label text-md-end">Alamat Email</label>
                        <div class="col-md-6">
                            <input id="email_mahasiswa" type="email_mahasiswa" class="form-control @error('email_mahasiswa') is-invalid @enderror" name="email_mahasiswa" value="{{ old('email_mahasiswa',$item->email_mahasiswa) }}" required autocomplete="email_mahasiswa">
                            @error('email_mahasiswa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                Ganti Password
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Ganti Password</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="btnClear" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Perbaharui
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
