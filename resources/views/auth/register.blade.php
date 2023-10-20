@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nomor_induk" class="col-md-4 col-form-label text-md-end">{{ __('NIP') }}</label>

                            <div class="col-md-6">
                                <input id="nomor_induk" type="text" class="form-control @error('nomor_induk') is-invalid @enderror" name="nomor_induk" value="{{ old('nomor_induk') }}" required autocomplete="nomor_induk" autofocus>

                                @error('nomor_induk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profesi" class="col-md-4 col-form-label text-md-end">Profesi</label>
                            <div class="col-md-6">
                                <select id="profesi" type="text" class="form-control" name="profesi" required>
                                    <option value="" selected>Pilih Profesi</option>
                                    <option value="Dosen" >Dosen</option>
                                    <option value="Staff">Staff</option>
                                    @error('profesi')
                                    <span class="invalid-feedback" role="alert"
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </select>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label>Jadikan Admin</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input id="roles" type="radio" class="form-check-input" value="0" name="roles" checked><label class="form-check-label" for="roles"> Tidak</label>
                                </div>
                                <div class="form-check">
                                    <input id="roles" type="radio" class="form-check-input" value="1" name="roles"><label class="form-check-label" for="roles"> Ya</label>
                                </div> 
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
    </div>
</div>
@endsection
