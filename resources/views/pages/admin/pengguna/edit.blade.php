@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">Edit Data Dosen -> {{ $item->name }}</h1> --}}
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
        <h5 class="card-header">Edit Profil
            <small id="makulHelp" class="font-weight-light">
                {{ $item->name }}
            </small>
        </h5>
        <div class="card-body">
            <div class="col-md-8">
                <form method="POST" action="{{ route('pengguna.update', $item->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <label for="nomor_induk" class="col-md-3 col-form-label text-md-end">NIP</label>
                        <div class="col-md-6">
                            <input id="nomor_induk" type="text" class="form-control @error('nomor_induk') is-invalid @enderror" name="nomor_induk" value="{{ old('nomor_induk',$item->nomor_induk) }}" required autocomplete="nomor_induk" autofocus>
                            @error('nomor_induk')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <label for="name" class="col-md-3 col-form-label text-md-end">Nama</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$item->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-3 col-form-label text-md-end">Username</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username',$item->username) }}" required autocomplete="name">
                            @error('username')
                            <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label text-md-end">Alamat Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$item->email) }}" required autocomplete="email">
                            @error('email')
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

                    <div class="form-group row" hidden>
                        <label for="profesi" class="col-md-3 col-form-label text-md-end">Status</label>
                        <div class="col-md-6">
                            <select id="profesi" type="text" class="form-control @error('profesi') is-invalid @enderror" name="profesi" required>
                                <option value="Dosen" {{$item->profesi == "Dosen" ? 'selected':''}}>Dosen</option>
                                <option value="Staff" {{$item->profesi == "Staff" ? 'selected':''}}>Staff</option>
                                @error('profesi')
                                <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </select>
                        </div>
                    </div>

                    @if (Auth::user()->roles == 1)
                    <div class="form-group row">
                        <label for="profesi" class="col-md-3 col-form-label text-md-end">Profesi</label>
                        <div class="col-md-6">
                            <select id="profesi" type="text" class="form-control @error('profesi') is-invalid @enderror" name="profesi" required>
                                <option value="Dosen" {{$item->profesi == "Dosen" ? 'selected':''}}>Dosen</option>
                                <option value="Staff" {{$item->profesi == "Staff" ? 'selected':''}}>Staff</option>
                                <option value="Mahasiswa" {{$item->profesi == "Mahasiswa" ? 'selected':''}}>Mahasiswa</option>
                                @error('profesi')
                                <span class="invalid-feedback" role="alert" <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="form-group row" hidden>
                        <label class="col-md-3 col-form-label text-md-end">Jadikan Admin</label>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input id="roles" type="radio" class="form-check-input" value="0" name="roles" {{$item->roles == 0 ? 'checked':''}}><label class="form-check-label" for="roles"> Tidak</label>
                            </div>
                            <div class="form-check">
                                <input id="roles" type="radio" class="form-check-input" value="1" name="roles" {{$item->roles == 1 ? 'checked':''}}><label class="form-check-label" for="roles"> Ya</label>
                            </div>
                        </div>
                    </div>

                    @if (Auth::user()->roles == 1)
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-end">Jadikan Admin</label>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input id="roles" type="radio" class="form-check-input" value="0" name="roles" {{$item->roles == 0 ? 'checked':''}}><label class="form-check-label" for="roles"> Tidak</label>
                            </div>
                            <div class="form-check">
                                <input id="roles" type="radio" class="form-check-input" value="1" name="roles" {{$item->roles == 1 ? 'checked':''}}><label class="form-check-label" for="roles"> Ya</label>
                            </div>
                        </div>
                    </div>
                    @endif

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