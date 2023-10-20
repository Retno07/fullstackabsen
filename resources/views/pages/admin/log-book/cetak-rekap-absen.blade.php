<!DOCTYPE html>
<html>

<head>
  <title>CETAK REKAP ABSEN PERKULIAHAN</title>
  <style>
   th {
      vertical-align: top;
    }
    p.prgh1 {
        font-size:16px;
        line-height: 0.5;
    }
    p.prgh2 {
        font-size:20px;
        line-height: 0.5;
        font-weight: bold;
    }
    p.prgh3 {
        font-size:18px;
        line-height: 0.5;
        font-weight: bold;
    }
    table {
        width: 100%;
    }
    td.weight1 {
        width:30
    }
    td.weight2 {
        width:100
    }

    td.line1 {
        border: 1px solid black;
        border-collapse: collapse;
    }
  </style>
</head>

<body>
    <p class="prgh2">UNIVERSITAS DHARMA AUB SURAKARTA</p>
    <p class="prgh1">Kampus : Jl. MW Maramis No 29 Cengklik Surakarta, Telepon (0271)857788<p>
  <center>
    <p class="prgh2">PRESENSI KULIAH</P>
    <p class="prgh3">SEMESTER {{ $detail_log->nama_semester_akademik }} TAHUN AKADEMIK {{ $detail_log->tahun_akademik }}</P>
    {{-- <p class="prgh3">PROGRAM STUDI : -----</P> --}}
  </center>
  <br></br>

  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
      {{--  @foreach ($detail_log as $dl)  --}}
          <table style="width: 100%" id="zero_config" class="table table-striped table-bordered">
            <thead>
                <tr align="center">
                  <td align="left">Kode</td>
                  <td align="left">:</td>
                  <td align="left"> {{ $detail_log->id_mata_kuliah }} </td>
                </tr>
            </thead>
            <thead>
                <tr align="center">
                  <td align="left">Kelas</td>
                  <td align="left">:</td>
                  <td align="left"> {{ $detail_log->kode_kelas }} </td>
                </tr>
            </thead>
            <thead>
                <tr align="center">
                  <td align="left">Mata Kuliah</td>
                  <td align="left">:</td>
                  <td align="left"> {{ $detail_log->nama_mata_kuliah }}</td>
                </tr>
            </thead>
            <thead>
                <tr align="center">
                  <td align="left">SKS</td>
                  <td align="left">:</td>
                  <td align="left">{{ $detail_log->sks_mata_kuliah }}</td>
                </tr>
            </thead>
            <thead>
              <tr align="center">
                <td align="left">Nama Dosen</td>
                <td align="left">:</td>
                <td align="left"> {{ $detail_log->name }}</td>
              </tr>
            </thead>
            <thead>
                <tr>
                    <td align="left" vertical-align="top">Prodi</td>
                    <td align="left">:</td>
                    <td align="left">
                    @foreach ($prodis as $item)
                        @if ($item->id_prodi_identity != NULL)
                            @for ($i=0;$i<$prod['prodi'];$i++)
                                <table>
                                    <tr>
                                        <td align="left"> {{get_valueProdi('prodi',($item->allprodi)[$i],'nama_prodi')}} </td>
                                    </tr>
                                </table>
                            @endfor
                        @endif
                    @endforeach
                    </td>
                </tr>
            </thead>
          </table>
        {{--  @endforeach  --}}
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
                        <tr>
                            <td rowspan="2" align='center'> No </td>
                            <td rowspan="2" align='center'> NIM </td>
                            <td class="weight2" rowspan="2" align='center'> NAMA MAHASISWA </td>
                            <td colspan="8" align='center'> TANDA TANGAN </td>

                        </tr>
                        <tr>
                            <td class="weight1" align='center'> 1 </td>
                            <td class="weight1" align='center'> 2 </td>
                            <td class="weight1" align='center'> 3 </td>
                            <td class="weight1" align='center'> 4 </td>
                            <td class="weight1" align='center'> 5 </td>
                            <td class="weight1" align='center'> 6 </td>
                            <td class="weight1" align='center'> 7 </td>
                            <td class="weight1" align='center'> 8 </td>
                        </tr>
                      </thead>
                    <tbody>
                        @foreach($mhs_absen as $ssss)
                        <tr align="center">
                            <td align="center">{{ ++$start }}</td>
                            <td align="left">{{ $ssss->nim_mahasiswa_absen }}</td>
                            <td align="left">{{ $ssss->nama_mahasiswa }}</td>
                            @if ($ssss->pertemuan1 == 1)
                                <td align="center"> Hadir</td>
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
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
          <div class="row">
            @foreach ($log as $key => $value)
              {{-- <table align='left' border='1'>
                <thead>
                  <tr>
                    <td colspan='3' align='center'> pertemuan {{ ++$start }} </td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($absen as $key => $value1)
                    @if ($value1->id_log == $value->id_log)
                      <tr>
                        <td width='20' align='center'>
                          {{ ++$urutan }}
                        </td>
                        <td width='100' align='center'>
                          {{ $value1->nim_mahasiswa_absen == ('') ? 'ksg' : $value1->nim_mahasiswa_absen }}
                        </td>
                        <td width='100'>
                          {{ $value1->nama_mahasiswa == ('') ? 'ksg' : $value1->nama_mahasiswa }}
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table> --}}
            @endforeach
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
