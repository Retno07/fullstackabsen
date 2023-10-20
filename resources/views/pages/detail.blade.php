@extends('layouts.app')


@section('title')
    Profil
@stop


@section('content')
    <main>
        <section class="section section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    Home
                                </li>
                                <li class="breadcrumb-item active">
                                    Profil
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7 pl-lg-0">
                        <div class="card card-details">
                            <h1>
                                {{ $item->nama_dokter }}
                            </h1>
                            <p>
                                {{ $item->bidang }}
                            </p>
                            @if($item->galleries->count() > 0)
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img
                                            src="{{ Storage::url($item->galleries->first()->image) }}"
                                            class="img-thumbnail"
                                            id="xzoom-default"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}"
                                        />
                                    </div>
                                </div>
                            @endif
                            <h2>Tentang Dokter</h2>
                            <p>
                                {{ $item->tentang_dokter }}
                            </p>
                            <h2>Riwayat Pendidikan</h2>
                            <p>
                                {{ $item->riwayat_pendidikan }}
                            </p>
                            <h2>Riwayat Pekerjaan:</h2>
                            <p>
                                {{ $item->riwayat_pekerjaan }}
                            </p>
                            <h2>Organisasi:</h2>
                            <p>
                                {{ $item->organisasi }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-details card-right">
                            <h2>{{ $item->nama_dokter }}</h2>
                            <hr>
                            <h2>Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th width="50%">Tempat & Tanggal Lahir:</th>
                                    <td width="50%" class="text-right">
                                        {{ $item->tempat_lahir }},{{date('d F Y', strtotime($item->tgl_lahir))}}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Bidang Keahlian:</th>
                                    <td width="50%" class="text-right">
                                        {{ $item->bidang }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            <a href="{{ route('schedule', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
                                Jadwal Dokter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@stop


@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333',
                Xoffset: 15
            });
        });
    </script>
@endpush