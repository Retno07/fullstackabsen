<!DOCTYPE html>
<html>

<head>
    <title>CETAK REKAP KRS</title>
    <style>
        th {
            vertical-align: top;
        }

        p.prgh1 {
            font-size: 16px;
            line-height: 0.5;
        }

        p.prgh2 {
            font-size: 20px;
            line-height: 0.5;
            font-weight: bold;
        }

        p.prgh3 {
            font-size: 18px;
            line-height: 0.5;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        td.weight {
            width: 60
        }

        td.weight1 {
            width: 20
        }

        td.weight2 {
            width: 150
        }

        td.weight3 {
            width: 25
        }

        td.line1 {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td.line2 {
            border: 0px;
        }
    </style>
</head>

<body>
    <center>
        <p class="prgh2">KARTU RENCANA STUDI & PRESENSI KULIAH MAHASISWA</p>
    </center>
    <br></br>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                {{-- @foreach ($detail_log as $dl)  --}}
                <table style="width: 100%" id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr align="left">
                            <td align="left" style="width: 90">Program Studi</td>
                            <td align="left" style="width: 40%">: {{ $mhs[0]->nama_prodi }}</td>
                            <td align="left" style="width: 90">Tahun Masuk</td>
                            <td align="left">: {{ $mhs[0]->tahun_masuk}} </td>
                        </tr>
                    </thead>
                    <thead>
                        <tr align="left">
                            <td align="left" style="width: 90">NIM</td>
                            <td align="left">: {{ $mhs[0]->nim_mahasiswa }}</td>
                            <td align="left" style="width: 90">Tahun Akademik</td>
                            <td align="left">: {{ $mhs2[0]->tahun_akademik }}</td>
                        </tr>
                    </thead>
                    <thead>
                        <tr align="left">
                            <td align="left" style="width: 90">Nama</td>
                            <td align="left">: {{ $mhs[0]->nama_mahasiswa }}</td>
                            <td align="left" style="width: 90">Pembimbing Akd</td>
                            <td align="left">: {{ $mhs[0]->name }}</td>
                        </tr>
                        <tr align="left">
                            <td align="left" style="width: 90">Semester</td>
                            @if ($mhs2[0]->nama_semester_akademik == 'GANJIL')
                            <td align="left">: 1</td>
                            @elseif ($mhs2[0]->nama_semester_akademik == 'GENAP')
                            <td align="left">: 2</td>
                            @endif
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>
                </table>
                {{-- @endforeach  --}}
            </div>
        </div>
    </div>
    <br></br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row">
                        <table style="border:1px solid black;border-collapse:collapse;" align='left' border='1'>
                            <thead>
                                <tr style="border:1px solid black;border-collapse:collapse;">
                                    <td class="weight3 line1" rowspan="2" align='center'> No </td>
                                    <td class="weight line1" rowspan="2" align='center'> KODE MK </td>
                                    <td class="weight2 line1" rowspan="2" align='center'> MATAKULIAH </td>
                                    <td class="weight1 line1" rowspan="2" align='center'> SKS </td>
                                    <td colspan="14" align='center'> FREKUENSI KEHADIRAN DOSEN & MAHASISWA </td>
                                    <td colspan="2" align='center'> EVALUASI </td>
                                </tr>
                                <tr style="border:1px solid black;border-collapse:collapse;">
                                    <td class="weight3 line1" align='center'> 1 </td>
                                    <td class="weight3 line1" align='center'> 2 </td>
                                    <td class="weight3 line1" align='center'> 3 </td>
                                    <td class="weight3 line1" align='center'> 4 </td>
                                    <td class="weight3 line1" align='center'> 5 </td>
                                    <td class="weight3 line1" align='center'> 6 </td>
                                    <td class="weight3 line1" align='center'> 7 </td>
                                    <td class="weight3 line1" align='center'> 8 </td>
                                    <td class="weight3 line1" align='center'> 9 </td>
                                    <td class="weight3 line1" align='center'> 10 </td>
                                    <td class="weight3 line1" align='center'> 11 </td>
                                    <td class="weight3 line1" align='center'> 12 </td>
                                    <td class="weight3 line1" align='center'> 13 </td>
                                    <td class="weight3 line1" align='center'> 14 </td>
                                    <td align='center'> MID </td>
                                    <td align='center'> SMT </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($krs as $ssss)
                                <tr align="center">
                                    <td align="center">{{ ++$start }}</td>
                                    <td align="center">{{ $ssss->id_makul_group }}</td>
                                    <td align="left">{{ $ssss->nama_mata_kuliah }}</td>
                                    <td align="center">{{ $ssss->sks_mata_kuliah }}</td>
                                    @if ($ssss->pertemuan1 == 1)
                                    <td align="center">Hadir</td>
                                    @elseif ($ssss->pertemuan1 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan1 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan2 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan2 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan2 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan3 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan3 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan3 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan4 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan4 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan4 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan5 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan5 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan5 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan6 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan6 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan6 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="left"></td>
                                    @endif
                                    @if ($ssss->pertemuan7 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan7 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan7 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan8 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan8 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan8 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan9 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan9 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan9 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan10 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan10 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan10 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan11 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan11 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan11 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan12 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan12 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan12 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan13 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan13 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan13 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuan14 == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuan14 == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuan14 == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuanUTS == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuanUTS == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuanUTS == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                    @if ($ssss->pertemuanSMT == 1)
                                    <td align="center"> Hadir</td>
                                    @elseif ($ssss->pertemuanSMT == 2)
                                    <td align="center"> Ijin</td>
                                    @elseif ($ssss->pertemuanSMT == 3)
                                    <td align="center"> Sakit</td>
                                    @else
                                    <td align="center"></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td colspan="3" align='center'> JUMLAH SKS </td>
                                <td class="weight1" align='center'> {{ $sks_tot }} </td>
                                <td colspan="16" align='center'> Surakarta, {{ $date  }}</td>
                            </tr>
                            <tr>
                                <td colspan="8" align='center' class="line2"> PEMBIMBING AKADEMIK <br><br><br><br> {{ $mhs[0]->name }} </td>
                                <td colspan="12" align='center' class="line2"> MAHASISWA <br><br><br><br> {{ $mhs[0]->nama_mahasiswa }} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        window.print();
    </script>

</body>

</html>