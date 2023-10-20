<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\LogBook;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Auth;
use PDF;

class AdminKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        if($request->has('search')){
            $items = Mahasiswa::where('deleted_at', NULL)->where('nama_mahasiswa','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = Mahasiswa::where('deleted_at', NULL)->simplePaginate($pagination);
        }

        return view('pages.admin.admin-kelas.index',[
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $nomor_induk)
    {
        $items = User::findOrFail($nomor_induk);

        // return view('pages.admin.admin-kelas.detail',[
        //     'item' => $item
        // ]);

        $pagination = 5;
        // $item = User::where('id','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        $logs = DB::table('users')
            ->select('*')
            ->join('identity_log_book', 'identity_log_book.id_dosen_identity', '=', 'users.id')
            // ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            // ->where('id', $id)
            // ->where('log.id_identity_log', $id_identity)
            // ->where('log.deleted_at', NULL)
            // ->where('log.log_is_verif', 1)
            ->where('id','LIKE','%' .$request->search.'%')->simplePaginate($pagination);

        return view('pages.admin.admin-kelas.detail',[
            'items' => $items,
            'logs' => $logs
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
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
    public function update(Request $data, $id)
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
        //
    }

    public function cetak_kelas(Request $request, $nim_mahasiswa)
    {
        $mhs = Mahasiswa::findOrFail($nim_mahasiswa);

        $pagination = 5;
        $items = DB::table('identity_log_book')
            ->distinct('id_makul_group')
            ->select('id_identity','name','nama_mata_kuliah','nama_kelas','tahun_akademik','nama_semester_akademik','id_prodi_identity','nim_mahasiswa_absen')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity' )
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->join('log', 'log.id_identity_log', '=', 'identity_log_book.id_identity')
            ->join('absen', 'absen.id_log_absen', '=', 'log.id_log')
            ->whereRaw('nim_mahasiswa_absen = ?', [$nim_mahasiswa])
            ->where('log.log_is_verif', 1)
            ->where('log.deleted_at', NULL)
            ->where('nama_mata_kuliah','LIKE','%' .$request->search.'%')->simplePaginate($pagination);

        return view('pages.admin.admin-kelas.detail',[
            'items' => $items,
            'mhs' => $mhs
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function detail_kelas_log(Request $request,$id_identity,$nim_mahasiswa_absen)
    {
        $items = LogBook::findOrFail($id_identity);

        $pagination = 5;
        if(auth()->user()->profesi=='Dosen'){
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
            ->where('nama_mata_kuliah','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
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

        $datas= ambil_satudataMakul('identity_log_book',$id_identity);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             $idmakulidentity = $data->id_makul_identity;
             if ($data->id_makul_identity != NULL) {
                $data->allmakul=encode($data->id_makul_identity);
                // $data->jum=encode($data->jumlah_obat);
                $num['makul']=sizeof($data->allmakul);
             }
             else {
                $num['makul']=0;
             }
        }

        $prodis= ambil_satudataMakul('identity_log_book',$id_identity);
        if ($prodis->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($prodis as $prodi) {
            //mencari id pasien dari id RM
             $idmakulidentity = $prodi->id_prodi_identity;
             if ($prodi->id_prodi_identity != NULL) {
                $prodi->allprodi=encode($prodi->id_prodi_identity);
                // $data->jum=encode($data->jumlah_obat);
                $prod['prodi']=sizeof($prodi->allprodi);
             }
             else {
                $prod['prodi']=0;
             }
        }

        //menghitung jumlah kehadiran mahasiswa
        $jumlah = DB::table('identity_log_book')
            ->select('*')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity' )
            ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
            ->join('log', 'log.id_identity_log', '=', 'identity_log_book.id_identity')
            ->join('absen', 'absen.id_log_absen', '=', 'log.id_log')
            ->where('nim_mahasiswa_absen', $nim_mahasiswa_absen)
            ->where('log.log_is_verif', 1)
            ->get();

        $jumlah_mhs = $jumlah->count();
        // dd($jumlah_mhs);

        return view('pages.admin.admin-kelas.kelas-detail',[
            'items' => $items,
            'logs' => $logs,
            'datas' => $datas,
            'num' => $num,
            'prodis' => $prodis,
            'prod' => $prod
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function cetak_rekap_krs($nim_mahasiswa)
    {
        $start = 0;

        $krs = LogBook::select('identity_log_book.id_makul_group', 'mata_kuliah.nama_mata_kuliah', 'mata_kuliah.sks_mata_kuliah',
        DB::raw('sum(CASE WHEN absen.pertemuan_log_absen = 1 THEN keterangan_log_absen ELSE 0 END) AS pertemuan1,
                    sum(CASE WHEN absen.pertemuan_log_absen = 2 THEN keterangan_log_absen ELSE 0 END) AS pertemuan2,
                    sum(CASE WHEN absen.pertemuan_log_absen = 3 THEN keterangan_log_absen ELSE 0 END) AS pertemuan3,
                    sum(CASE WHEN absen.pertemuan_log_absen = 4 THEN keterangan_log_absen ELSE 0 END) AS pertemuan4,
                    sum(CASE WHEN absen.pertemuan_log_absen = 5 THEN keterangan_log_absen ELSE 0 END) AS pertemuan5,
                    sum(CASE WHEN absen.pertemuan_log_absen = 6 THEN keterangan_log_absen ELSE 0 END) AS pertemuan6,
                    sum(CASE WHEN absen.pertemuan_log_absen = 7 THEN keterangan_log_absen ELSE 0 END) AS pertemuan7,
                    sum(CASE WHEN absen.pertemuan_log_absen = 8 THEN keterangan_log_absen ELSE 0 END) AS pertemuan8,
                    sum(CASE WHEN absen.pertemuan_log_absen = 9 THEN keterangan_log_absen ELSE 0 END) AS pertemuan9,
                    sum(CASE WHEN absen.pertemuan_log_absen = 10 THEN keterangan_log_absen ELSE 0 END) AS pertemuan10,
                    sum(CASE WHEN absen.pertemuan_log_absen = 11 THEN keterangan_log_absen ELSE 0 END) AS pertemua11,
                    sum(CASE WHEN absen.pertemuan_log_absen = 12 THEN keterangan_log_absen ELSE 0 END) AS pertemuan12,
                    sum(CASE WHEN absen.pertemuan_log_absen = 13 THEN keterangan_log_absen ELSE 0 END) AS pertemuan13,
                    sum(CASE WHEN absen.pertemuan_log_absen = 14 THEN keterangan_log_absen ELSE 0 END) AS pertemuan14'))
        ->leftjoin('log', 'log.id_identity_log', '=', 'identity_log_book.id_identity')
        ->leftjoin('absen', 'absen.id_log_absen', '=', 'log.id_log')
        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
        ->whereRaw('absen.nim_mahasiswa_absen = ?', [$nim_mahasiswa])
        ->groupBy('identity_log_book.id_makul_group','mata_kuliah.nama_mata_kuliah','mata_kuliah.sks_mata_kuliah')->get();

        $mhs = Mahasiswa::join('users', 'users.id', '=', 'mahasiswa.id_dosen')
        ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->whereRaw('nim_mahasiswa = ?', [$nim_mahasiswa])->get();

        $mhs2 = Mahasiswa::join('users', 'users.id', '=', 'mahasiswa.id_dosen')
        ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
        ->join('identity_log_book_detail', 'identity_log_book_detail.id_mhs_identity', '=', 'mahasiswa.nim_mahasiswa')
        ->join('identity_log_book', 'identity_log_book_detail.id_identity_logbook', '=', 'identity_log_book.id_identity')
        ->join('akademik', 'akademik.id_akademik', '=', 'identity_log_book.id_akademik_identity')
        ->whereRaw('nim_mahasiswa = ?', [$nim_mahasiswa])->get();

        $sks_tot = $krs->sum('sks_mata_kuliah');

        // $date = date('d-m-Y', strtotime($user->from_date));
        $date = Carbon::now()->isoFormat('D MMMM Y');

        $data = PDF::loadview('pages.admin.admin-kelas.cetak-rekap-krs',[
            'krs' => $krs,
            'start' => $start,
            'sks_tot' => $sks_tot,
            'mhs' => $mhs,
            'mhs2' => $mhs2,
            'date' => $date
        ])->setPaper('a4', 'landscape');

        //mendownload laporan.pdf
    	return $data->stream('cetak-rekap-krs.pdf');
    }
}
