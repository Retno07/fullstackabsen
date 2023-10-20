<!DOCTYPE html>
<html>

<head>
  <title>CETAK LOG BOOK PERKULIAHAN</title>
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

    td.line2 {
      border: 0px;
    }

    td.line1 {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <p class="prgh2">UNIVERSITAS DHARMA AUB SURAKARTA</p>
  <p class="prgh1">Kampus : Jl. MW Maramis No 29 Cengklik Surakarta, Telepon (0271)857788
  <p>
    <center>
      <p class="prgh2">LOG BOOK PERKULIAHAN</P>
    </center>
    <br></br>


  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        {{-- @foreach ($detail_log as $dl)  --}}
        <table style="width: 100%" id="zero_config" class="table table-striped table-bordered">
          <thead>
            <tr align="center">
              <td align="left">Nama Dosen</td>
              <td align="left">:</td>
              <td align="left"> {{ $detail_log->name }}</td>
              <td align="left">Mata Kuliah</td>
              <td align="left">: {{ $detail_log->nama_mata_kuliah }}</td>
            </tr>
          </thead>
          <thead>
            <tr align="center">
              <td align="left">Kelas</td>
              <td align="left">:</td>
              <td align="left"> {{ $detail_log->nama_kelas }} ({{ $detail_log->jml_mhs }} Mahasiswa)</td>
              <td align="left">Jumlah SKS</td>
              <td align="left">: {{ $detail_log->sks_mata_kuliah }}</td>
            </tr>
          </thead>
          <thead>
            <tr align="center">
              <td align="left">Tahun Akademik</td>
              <td align="left">:</td>
              <td align="left"> {{ $detail_log->tahun_akademik }} - {{ $detail_log->nama_semester_akademik }}</td>
              <td align="left">Semester</td>
              <td align="left">: {{ $detail_log->semester_mata_kuliah }}</td>
            </tr>
          </thead>
          <thead>
            <tr>
              <td align="left" vertical-align="top">Prodi</td>
              <td align="left">:</td>
              <td align="left">
                @foreach ($prodis as $item)
                @if ($item->id_prodi_identity != NULL)
                @for ($i=0;$i<$prod['prodi'];$i++) <table>
            <tr>
              <td align="left"> {{get_valueProdi('prodi',($item->allprodi)[$i],'nama_prodi')}} </td>
            </tr>
        </table>
        @endfor
        @endif
        @endforeach
        </th>
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
          <table border="1" style="border:1px solid black;border-collapse:collapse;" align='left' border='1'>
            <thead>
              <tr align="center" style="border:1px solid black;border-collapse:collapse;">
                <td><b>Minggu Ke</b></td>
                <td><b>Ruang</b></td>
                <td><b>Tanggal</b></td>
                <td><b>Waktu Mulai</b></td>
                <td><b>Waktu Selesai</b></td>
                <td><b>Materi</b></td>
                <td><b>Jenis Perkuliahan</b></td>
                <td><b>Jumlah Mahasiswa</b></td>
              </tr>
            </thead>
            <tbody>
              @foreach ($detail as $de)
              <tr align="center">
                <td>{{ ++$start }}</td>
                <td>{{ $de->nama_ruang }}</td>
                <td>{{ $de->hari_log }}</td>
                <td>{{ $de->waktu_mulai_log }}</td>
                <td>{{ $de->waktu_selesai_log }}</td>
                <td>{{ $de->materi_log }}</td>
                <td>{{ $de->metode_pbm_log }}</td>
                <td>{{ $de->jumlah_mhs_hadir_log }}/{{ $de->jml_mhs }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



  <script>
    window.print();
  </script>

</body>

</html>