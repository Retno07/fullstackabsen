<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LogBookRequest;
use App\Models\LogBook;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Makul;
use App\Models\ThnAkademik;
use App\Models\Mahasiswa;
use App\Models\Absen;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        // if (auth()->user()->profesi=='Dosen'){
        //     $items = LogBook::where('id_dosen_identity', Auth::user()->id)->where('id_dosen_identity','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        // }else {
        //     $items = LogBook::where('id_dosen_identity','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        // }

        if (auth()->user()->profesi == 'Dosen') {
            $items = DB::table('identity_log_book')
                ->select('*')
                ->join('mata_kuliah', 'identity_log_book.id_makul_group', '=', 'mata_kuliah.id_mata_kuliah')
                ->join('users', 'identity_log_book.id_dosen_identity', '=', 'users.id')
                ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
                ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
                ->where('id_dosen_identity', Auth::user()->id)
                ->where('identity_log_book.deleted_at', NULL)
                ->where('nama_mata_kuliah', 'LIKE', '%' . $request->search . '%')->simplePaginate($pagination);
        } else {
            $items = DB::table('identity_log_book')
                ->select('*')
                ->join('mata_kuliah', 'identity_log_book.id_makul_group', '=', 'mata_kuliah.id_mata_kuliah')
                ->join('users', 'identity_log_book.id_dosen_identity', '=', 'users.id')
                ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
                ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
                ->where('identity_log_book.deleted_at', NULL)
                ->where('nama_mata_kuliah', 'LIKE', '%' . $request->search . '%')->simplePaginate($pagination);
        }

        return view('pages.admin.log-book.index', [
            'items' => $items
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('profesi', 'dosen')->get();
        $prodi = Prodi::all();
        $kelas = Kelas::all();
        $tahun = ThnAkademik::all();
        $mhs = Mahasiswa::all();

        return view('pages.admin.log-book.create', [
            'users' => $users,
            'prodi' => $prodi,
            'kelas' => $kelas,
            'tahun' => $tahun,
            'mhs' => $mhs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogBookRequest $request)
    {
        $this->validate($request, [
            'id_dosen_identity' => 'required',
            'id_kelas_identity' => 'required',
            'jml_mhs' => 'required|max:225',
            'id_akademik_identity' => 'required',
            'id_makul_identity' => 'required',
            'inputs.*.id_mhs_identity' => 'required',
        ]);

        // Decoding array input makul
        if (isset($request->makul)) {
            $makul_id = decode('makul', 'id_makul_identity', $request->makul);
            $id_prodi = decode('makul', 'id_prodi_identity', $request->makul);
        } else {
            $makul_id = "";
            $id_prodi = "";
        }

        DB::table('identity_log_book')->insert([
            'id_dosen_identity' => $request->id_dosen_identity,
            'id_kelas_identity' => $request->id_kelas_identity,
            'jml_mhs' => $request->jml_mhs,
            'id_akademik_identity' => $request->id_akademik_identity,
            'id_makul_identity' => $makul_id,
            'id_prodi_identity' => $id_prodi,
            'id_makul_group' => $request->id_makul_identity,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $identity = DB::getPdo()->lastInsertId();

        foreach ($request->inputs as $key => $value) {
            $data = array(
                'id_identity_logbook' => $identity,
                'id_mhs_identity' => $value['id_mhs_identity'],
                'nama_mahasiswa' => $value['nama_mahasiswa'],
            );
            DB::table('identity_log_book_detail')->insert($data);
        }

        $ids = DB::table('identity_log_book')->latest('created_at')->first();
        switch ($request->simpan) {
            case 'simpan_edit':
                $buka = route('log-book.index', $ids->id_identity);
                $pesan = 'Log Book berhasil disimpan!';
                break;
        }

        return redirect()->route('log-book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id_identity)
    {
        $items = LogBook::findOrFail($id_identity);

        $pagination = 5;
        if (auth()->user()->profesi == 'Dosen') {
            $logs = DB::table('log')
                ->select('*')
                ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
                ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
                ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
                ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
                ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
                ->where('id_dosen_identity', Auth::user()->id)
                ->whereRaw('log.id_identity_log = ?', [$id_identity])
                ->where('log.deleted_at', NULL)
                ->where('log.log_is_verif', 1)
                ->where('pertemuan_log', 'LIKE', '%' . $request->search . '%')->simplePaginate($pagination);
        } else {
            $logs = DB::table('log')
                ->select('*')
                ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
                ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
                ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
                ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
                ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
                ->whereRaw('log.id_identity_log = ?', [$id_identity])
                ->where('log.deleted_at', NULL)
                ->where('log.log_is_verif', 1)
                ->simplePaginate($pagination);
        }

        $datas = ambil_satudataMakul('identity_log_book', $id_identity);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
            $idmakulidentity = $data->id_makul_identity;
            if ($data->id_makul_identity != NULL) {
                $data->allmakul = encode($data->id_makul_identity);
                // $data->jum=encode($data->jumlah_obat);
                $num['makul'] = sizeof($data->allmakul);
            } else {
                $num['makul'] = 0;
            }
        }

        $prodis = ambil_satudataMakul('identity_log_book', $id_identity);
        if ($prodis->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($prodis as $prodi) {
            //mencari id pasien dari id RM
            $idmakulidentity = $prodi->id_prodi_identity;
            if ($prodi->id_prodi_identity != NULL) {
                $prodi->allprodi = encode($prodi->id_prodi_identity);
                // $data->jum=encode($data->jumlah_obat);
                $prod['prodi'] = sizeof($prodi->allprodi);
            } else {
                $prod['prodi'] = 0;
            }
        }

        $mhs = LogBook::join('identity_log_book_detail', 'identity_log_book.id_identity', '=', 'identity_log_book_detail.id_identity_logbook')
            ->whereRaw('identity_log_book_detail.id_identity_logbook = ?', [$id_identity])
            ->where('nama_mahasiswa', 'LIKE', '%' . $request->search2 . '%')
            ->get(['identity_log_book_detail.nama_mahasiswa']);

        // ---/
        $start = 0;

        return view('pages.admin.log-book.detail', [
            'items' => $items,
            'logs' => $logs,
            'datas' => $datas,
            'num' => $num,
            'prodis' => $prodis,
            'prod' => $prod,
            'mhs' => $mhs,
            'start' => $start
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);

        // return view('pages.admin.log-book.detail',[
        //     'items' => $items
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MakulRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = LogBook::findOrFail($id);
        $item->delete();

        return redirect()->route('log-book.index');
    }

    public function getMakul(Request $request)
    {
        $data['mata_kuliah'] = Makul::where("id_prodi", $request->id_prodi)
            ->get(["nama_mata_kuliah", "id_mata_kuliah"]);

        return response()->json($data);
    }

    public function cetak_logbook($id_identity)
    {
        $detail_log = DB::table('identity_log_book')
            ->select('*')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->whereRaw('id_identity = ?', [$id_identity])->first();

        $detail = DB::table('absen')
            ->select('ruang.nama_ruang', 'log.hari_log', 'log.waktu_mulai_log', 'log.waktu_selesai_log', 'log.materi_log', 'log.metode_pbm_log', 'log.jumlah_mhs_hadir_log', 'identity_log_book.jml_mhs')
            ->join('log', 'log.id_log', '=', 'absen.id_log_absen')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->whereRaw('id_identity_log = ?', [$id_identity])
            ->where('log_is_verif', 1)
            ->where('log.deleted_at', NULL)
            ->groupBy('id_log', 'nama_ruang', 'hari_log', 'waktu_mulai_log', 'waktu_selesai_log', 'materi_log', 'metode_pbm_log', 'jumlah_mhs_hadir_log', 'identity_log_book.jml_mhs')->get();

        $prodis = ambil_satudataMakul('identity_log_book', $id_identity);
        if ($prodis->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($prodis as $prodi) {
            //mencari id pasien dari id RM
            $idmakulidentity = $prodi->id_prodi_identity;
            if ($prodi->id_prodi_identity != NULL) {
                $prodi->allprodi = encode($prodi->id_prodi_identity);
                // $data->jum=encode($data->jumlah_obat);
                $prod['prodi'] = sizeof($prodi->allprodi);
            } else {
                $prod['prodi'] = 0;
            }
        }

        $start = 0;

        $data = PDF::loadview('pages.admin.log-book.cetak-logbook', [
            'detail_log' => $detail_log,
            'detail' => $detail,
            'start' => $start,
            'prodis' => $prodis,
            'prod' => $prod
        ]);

        //mendownload laporan.pdf
        return $data->stream('cetak_logbook.pdf');
    }

    public function cetak_rekap_absen($id_identity)
    {
        $detail_log = DB::table('identity_log_book')
            ->select('*')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->whereRaw('id_identity = ?', [$id_identity])->first();

        $log = DB::table('log')
            ->select('*')
            ->whereRaw('id_identity_log = ?', [$id_identity])
            ->where('log_is_verif', 1)
            ->where('deleted_at', NULL)->get();

        $absen = DB::table('absen')
            ->select('*')
            ->join('log', 'log.id_log', '=', 'absen.id_log_absen')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->whereRaw('id_identity_log = ?', [$id_identity])
            ->where('log_is_verif', 1)
            ->where('log.deleted_at', NULL)->get();

        $mhs_absen = Absen::select(
            'absen.nim_mahasiswa_absen',
            'mahasiswa.nama_mahasiswa',
            DB::raw('sum(CASE WHEN absen.pertemuan_log_absen = 1 THEN keterangan_log_absen ELSE 0 END) AS pertemuan1,
                    sum(CASE WHEN absen.pertemuan_log_absen = 2 THEN keterangan_log_absen ELSE 0 END) AS pertemuan2,
                    sum(CASE WHEN absen.pertemuan_log_absen = 3 THEN keterangan_log_absen ELSE 0 END) AS pertemuan3,
                    sum(CASE WHEN absen.pertemuan_log_absen = 4 THEN keterangan_log_absen ELSE 0 END) AS pertemuan4,
                    sum(CASE WHEN absen.pertemuan_log_absen = 5 THEN keterangan_log_absen ELSE 0 END) AS pertemuan5,
                    sum(CASE WHEN absen.pertemuan_log_absen = 6 THEN keterangan_log_absen ELSE 0 END) AS pertemuan6,
                    sum(CASE WHEN absen.pertemuan_log_absen = 7 THEN keterangan_log_absen ELSE 0 END) AS pertemuan7,
                    sum(CASE WHEN absen.pertemuan_log_absen = 8 THEN keterangan_log_absen ELSE 0 END) AS pertemuan8')
        )
            ->join('log', 'log.id_log', '=', 'absen.id_log_absen')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->whereRaw('identity_log_book.id_identity = ?', [$id_identity])
            ->groupBy('absen.nim_mahasiswa_absen', 'mahasiswa.nama_mahasiswa')
            ->orderBy('mahasiswa.id_prodi', 'ASC')
            ->orderBY('mahasiswa.nim_mahasiswa', 'ASC')->get();

        $prodis = ambil_satudataMakul('identity_log_book', $id_identity);
        if ($prodis->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($prodis as $prodi) {
            //mencari id pasien dari id RM
            $idmakulidentity = $prodi->id_prodi_identity;
            if ($prodi->id_prodi_identity != NULL) {
                $prodi->allprodi = encode($prodi->id_prodi_identity);
                // $data->jum=encode($data->jumlah_obat);
                $prod['prodi'] = sizeof($prodi->allprodi);
            } else {
                $prod['prodi'] = 0;
            }
        }

        $start = 0;
        $urutan = 0;

        $data = PDF::loadview('pages.admin.log-book.cetak-rekap-absen', [
            'detail_log' => $detail_log,
            'absen' => $absen,
            'start' => $start,
            'urutan' => $urutan,
            'prodis' => $prodis,
            'prod' => $prod,
            'log' => $log,
            'mhs_absen' => $mhs_absen
        ]);

        //mendownload laporan.pdf
        return $data->stream('cetak-rekap-absen.pdf');
    }
}
