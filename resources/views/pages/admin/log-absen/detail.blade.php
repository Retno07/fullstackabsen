@extends('layouts.admin')

@section('content')
    {{--  <!-- Begin Page Content -->  --}}
<div class="container-fluid">

    {{--  <!-- Page Heading -->  --}}
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
                <div class="text-center">
                    @if(\Session::has('qrImage'))
                        <div class="mb-3">
                            <img src="{{ asset(\Session::get('qrImage')) }}" class="img img-responsive">
                        </div>
                        {{ \Session::forget('qrImage') }}
                    @endif
                </div>
                <br>
            </form>
            <a button href="{{ route('lihat_absen', $items->id_log) }}" class="btn btn-primary btn-block">Lihat</button></a>
        </div>
    </div>
</div>
@endsection

