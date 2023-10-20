@extends('layouts.admin')

@section('content')
{{-- <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{-- <!-- Page Heading -->  --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">QR-CODE</h1> --}}
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
        <h5 class="card-header">QR-CODE</h5>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="card-title" align="center">SCAN QR SEKARANG !</h4>
                <br>
                <p align="center"><img class="img" src="{{ asset("{$items->qr_code_log}") }}" height="500px"></p>
                <br>
            </form>
            <p align="center"><a button href="{{ route('log-perkuliahan.index') }}" class="btn btn-danger">Kembali</button></a></p>
        </div>
    </div>
</div>
@endsection
