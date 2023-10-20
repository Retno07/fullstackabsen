<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-text mx-3">Absensi Qr</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    @if (auth()->user()->profesi=='Staff')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Admin</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Utama
    </div>

    <li class="nav-item @yield('log-book')">
        <a class="nav-link" href="{{ route('log-book.index') }}">
            <i class="fas fa-fw fa fa-server"></i>
            <span>Log Book</span></a>
    </li>

    <li class="nav-item @yield('admin-kelas')">
        <a class="nav-link" href="{{ route('admin-kelas.index') }}">
            <i class="fas fa-fw fa fa-clipboard"></i>
            <span>Kelas</span></a>
    </li>
    @if (Auth::user()->roles == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Tambahan
    </div>

    <li class="nav-item @yield('pengguna')">
        <a class="nav-link" href="{{ route('pengguna.index') }}">
            <i class="fas fa-fw fa fa-id-badge"></i>
            <span>Pengguna</span></a>
    </li>
    <li class="nav-item @yield('mahasiswa')">
        <a class="nav-link" href="{{ route('mahasiswa.index') }}">
            <i class="fas fa-fw fa fa-graduation-cap"></i>
            <span>Mahasiswa</span></a>
    </li>
    <li class="nav-item @yield('prodi')">
        <a class="nav-link" href="{{ route('prodi.index') }}">
            <i class="fas fa-fw fa fa-university"></i>
            <span>Prodi</span></a>
    </li>
    <li class="nav-item @yield('makul')">
        <a class="nav-link" href="{{ route('makul.index') }}">
            <i class="fas fa-fw fa fa-desktop"></i>
            <span>Mata Kuliah</span></a>
    </li>
    <li class="nav-item @yield('kode-kelas')">
        <a class="nav-link" href="{{ route('kode-kelas.index') }}">
            <i class="fas fa-fw fa fa-columns"></i>
            <span>Kode Kelas</span></a>
    </li>
    <li class="nav-item @yield('ruang')">
        <a class="nav-link" href="{{ route('ruang.index') }}">
            <i class="fas fa-fw fa fa-building"></i>
            <span>Ruang</span></a>
    </li>
    <li class="nav-item @yield('thn-akademik')">
        <a class="nav-link" href="{{ route('thn-akademik.index') }}">
            <i class="fas fa-fw fa fa-calendar"></i>
            <span>Tahun Akademik</span></a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Rekam Medis</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('add-rekam-medis.index') }}">Tambah Rekam Medis</a>
    <a class="collapse-item" href="{{ route('rekam-medis.index') }}">Data Rekam Medis</a>
    </div>
    </div>
    </li> --}}
    @endif

    @elseif (auth()->user()->profesi=='Dosen')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Menu Dosen
    </div>

    <li class="nav-item @yield('dashboard')">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard Dosen</span></a>
    </li>

    <li class="nav-item @yield('log-absen')">
        <a class="nav-link" href="{{ route('log-absen.index') }}">
            <i class="fas fa-fw fa fa-qrcode"></i>
            <span>Presensi</span></a>
    </li>
    <li class="nav-item @yield('log-perkuliahan')">
        <a class="nav-link" href="{{ route('log-perkuliahan.index') }}">
            <i class="fas fa-fw fa fa-desktop"></i>
            <span>Log Perkuliahan</span></a>
    </li>
    <li class="nav-item @yield('log-book')">
        <a class="nav-link" href="{{ route('log-book.index') }}">
            <i class="fas fa-fw fa fa-server"></i>
            <span>Log Book</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->