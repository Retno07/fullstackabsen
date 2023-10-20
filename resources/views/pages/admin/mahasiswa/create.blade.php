@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Tambah Data Mahasiswa</h1> --}}
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
        <h5 class="card-header">Tambah Data Mahasiswa</h5>
        <div class="card-body">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nim_mahasiswa" class="col-md-4 col-form-label text-md-end">{{ __('NIM') }}</label>

                    <div class="col-md-6">
                        <input id="nim_mahasiswa" type="number" class="form-control @error('nim_mahasiswa') is-invalid @enderror" name="nim_mahasiswa" value="{{ old('nim_mahasiswa') }}" required autocomplete="nim_mahasiswa" autofocus>

                        @error('nim_mahasiswa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="nama_mahasiswa" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                    <div class="col-md-6">
                        <input id="nama_mahasiswa" type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required autocomplete="nama_mahasiswa" autofocus>

                        @error('nama_mahasiswa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama_prodi" class="col-md-4 col-form-label text-md-end">{{ __('Prodi') }}</label>
                    <div class="col-md-6">
                        <select name="id_prodi" required class="form-control">
                            <option value="">Pilih Prodi</option>
                            @foreach($prodi as $prodi)
                            <option value="{{ $prodi->id_prodi}}">
                                {{ $prodi->nama_prodi }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tahun_masuk" class="col-md-4 col-form-label text-md-end">{{ __('Tahun Masuk') }}</label>

                    <div class="col-md-6">
                        <input id="tahun_masuk" type="number" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk" value="{{ old('tahun_masuk') }}" required autocomplete="tahun_masuk" autofocus>

                        @error('tahun_masuk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Dosen Pembimbing Akademik') }}</label>

                    <div class="col-md-6">
                        <select name="id_dosen" required class="form-control">
                            <option value="">Pilih Dosen PA</option>
                            @foreach($user as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{--
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
        </div> --}}

        <div class="row mb-3">
            <label for="email_mahasiswa" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

            <div class="col-md-6">
                <input id="email_mahasiswa" type="email" class="form-control @error('email_mahasiswa') is-invalid @enderror" name="email_mahasiswa" value="{{ old('email_mahasiswa') }}" required autocomplete="email_mahasiswa">

                @error('email_mahasiswa')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password_mahasiswa" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password_mahasiswa" type="password" class="form-control @error('password_mahasiswa') is-invalid @enderror" name="password_mahasiswa" required autocomplete="new-password_mahasiswa">

                @error('password_mahasiswa')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
@endsection
