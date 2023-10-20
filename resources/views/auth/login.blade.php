@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="section-right col-12 col-md-4">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center">
                            <img src="frontend/images/logo_absen.png" alt="" width="100" height="100">
                        </div>

                        <form>
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                </div> --}}
                <button type="submit" class="btn btn-login btn-block">
                    {{ __('Sign In') }}
                </button>

                {{-- @if (Route::has('password.request'))
                                <p class="text-center mt-4">
                                    <a href="{{ route('password.request') }}">
                {{ __('Saya Lupa Password') }}
                </a>
                </p>
                @endif --}}
                <br><br>
                <h4 class="mt-2mb-0">Note</h4>
                <p class="disclaimer mb-0">
                    Halaman ini di khususkan untuk login staff dan dosen.
                </p>
                </form>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
