{{-- <!-- Navbar  -->  --}}
<div class="container">
    <nav class="row navbar navbar-expand-lg navbar-light bg-white">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('../frontend/images/logo_undha.png') }}" alt="Logo">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3">
                <li class="nav-item mx-md-2">
                    <a href="{{ url('/') }}" class="nav-link active">Home</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="#footer" class="nav-link">Kontak</a>
                </li>

                @guest
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Presensi Perkuliahan</a>
                    <div class="dropdown-menu">
                        <a href="{{ url('office')}}" class="dropdown-item">Login</a>
                    </div>
                </li>
                @endguest

                @auth
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Presensi Perkuliahan</a>
                    <div class="dropdown-menu">
                        <a href="{{ url('/logout')}}" class="dropdown-item">Logout</a>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
</div>