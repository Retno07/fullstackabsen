<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LogAbsenRequest;
use App\Http\Requests\Admin\AbsenRequest;
use Auth;
use Storage;
use App\Models\LogAbsen;
use App\Models\Logbook;
use App\Models\Ruang;
use App\Models\Absen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LogAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ruang = Ruang::get();

        $logbook = DB::table('identity_log_book')
        ->select('*')
        ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
        ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
        // ->join('prodi', 'prodi.id_prodi', '=', 'identity_log_book.id_prodi_identity')
        ->where('identity_log_book.deleted_at', NULL)
        ->where('id_dosen_identity', Auth::user()->id)->get();

        return view('pages.admin.log-absen.index',[
            'logbook' => $logbook,
            'ruang' => $ruang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pagination = 5;
        if($request->has('search')){
            $items = DB::table('absen')
            ->select('*')
            ->join('users', 'users.nomor_induk', '=', 'absen.nim_mahasiswa_absen')
            ->where('name','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DB::table('absen')
            ->select('*')
            ->join('users', 'users.nomor_induk', '=', 'absen.nim_mahasiswa_absen')
            ->simplePaginate($pagination);
        }

        $id_log = LogAbsen::latest()->first()->id_log;

        $jml_mhs = LogAbsen::where('id_log',$id_log)->first();
        $this->jumlah_mhs_hadir_log = $jml_mhs['jumlah_mhs_hadir_log'];

        $mhs = Mahasiswa::all();
        $pertemuan_log = DB::table('log')
            ->select('pertemuan_log')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->where('log_is_verif', 0)
            ->where('id_dosen_identity', Auth::user()->id)->latest('log.created_at')->first()->pertemuan_log;

        $id_log_absen = DB::table('log')
            ->select('id_log')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->where('log_is_verif', 0)
            ->where('id_dosen_identity', Auth::user()->id)->latest('log.created_at')->first()->id_log;

        return view('pages.admin.log-absen.create',[
            'items' => $items,
            'jml_mhs' => $jml_mhs,
            'mhs' => $mhs,
            'id_log_absen' => $id_log_absen,
            'pertemuan_log' => $pertemuan_log
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenRequest $request)
    {
        // $data = $request->all();
        // Ruang::create($data);

        // return redirect()->route('ruang.index');

        $this->validate($request, [
            'nim_mahasiswa_absen' =>'required',
            'keterangan_log_absen' =>'required',
            'id_log_absen' =>'required|max:225',
            'pertemuan_log_absen' =>'required',
        ]);

        DB::table('absen')->insert([
            'nim_mahasiswa_absen' => $request->nim_mahasiswa_absen,
            'keterangan_log_absen' => $request->keterangan_log_absen,
            'id_log_absen' => $request->id_log_absen,
            'pertemuan_log_absen' => $request->pertemuan_log_absen,
        ]);

        return redirect()->route('log-perkuliahan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $items = Absen::findOrFail($id);

        // return view('pages.admin.log-perkuliahan.detail',[
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
        DB::table('absen')->where('id_absen', $id)->delete();
        return back();
    }

    public function generate(Request $request)
    {
        $name = Auth::user()->name;
        $data = $this->validate($request, [
            'id_identity_log' =>'required|max:225',
            'hari_log' =>'required|max:225',
            'waktu_mulai_log' =>'required|max:225',
            'waktu_selesai_log' =>'required|max:225',
            'id_ruang_log' =>'required|max:225',
            'materi_log' =>'required|max:225',
            'metode_pbm_log' =>'required|max:225',
            'pertemuan_log' =>'required|max:225',
        ]);

        // $data = DB::table('log')->insert(
        //     [
        //     'id_identity_log' => $request->id_identity_log,
        //     'hari_log' => $request->hari_log,
        //     'waktu_mulai_log' => $request->waktu_mulai_log,
        //     'waktu_selesai_log' => $request->waktu_selesai_log,
        //     'id_ruang_log' => $request->id_ruang_log,
        //     'materi_log' => $request->materi_log,
        //     'metode_pbm_log' => $request->metode_pbm_log,
        //     ]
        // );
        // $data = $request->all();
        LogAbsen::create($data);

        $id_log = DB::getPdo()->lastInsertId();

        $pertemuan_logs = LogAbsen::select('pertemuan_log','metode_pbm_log','id_identity_log')->where('id_log',$id_log)->first();
        $pertemuan_log = $pertemuan_logs['pertemuan_log'];
        $jenis_perkuliahan = $pertemuan_logs['metode_pbm_log'];
        $id_identity_log = $pertemuan_logs['id_identity_log'];

        $time = time();
        $path = 'storage/assets/gallery/';
        if(!\File::exists(public_path($path))) {
            \File::makeDirectory(public_path($path), $mode = 0777, true, true);
        }
        $image = \QrCode::size(500)->generate('{"dosen":"'.$name.'", "id_log":"'.$id_log.'", "id_identity_log":"'.$id_identity_log.'", "pertemuan_log":"'.$pertemuan_log.'", "jenis_perkuliahan":"'.$jenis_perkuliahan.'"}', $path.$time.'.svg');
        $img_url = $path.$time.'.svg';
        \Session::put('qrImage', $img_url);

        DB::table('log')
            ->where('id_log',$id_log)
            ->update(['qr_code_log' => $img_url]);

        // $items = DB::table('log')
        //     ->select('*')
        //     ->where('id_log', $id_log);

        $items = LogAbsen::where('id_log',$id_log)->first();
        $this->id_log = $items['id_log'];

        return view('pages.admin.log-absen.detail',[
            'items' => $items,
        ]);
    }

    public function lihat_absen(Request $request,$id_log)
    {
        $pagination = 5;
        if($request->has('search')){
            $items = DB::table('absen')
            ->select('*')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->join('log', 'log.id_log', '=', 'absen.id_log_absen')
            ->whereRaw('id_log_absen = ?', [$id_log])
            ->where('nama_mahasiswa','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DB::table('absen')
            ->select('*')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->join('log', 'log.id_log', '=', 'absen.id_log_absen')
            ->whereRaw('id_log_absen = ?', [$id_log])

            ->simplePaginate($pagination);
        }

        $jumlah = DB::table('absen')
            ->select('*')
            ->whereRaw('id_log_absen = ?', [$id_log])->get();
        $jumlah_mhs = $jumlah->count();

        return view('pages.admin.log-absen.dosen-absen',[
            'items' => $items,
            'jumlah_mhs' => $jumlah_mhs
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function verif_jml_mhs(Request $request)
    {
        $id_log = $request->input('id');

        $items = DB::table('log')
            // ->where('id_log',$id_log)
            ->whereRaw('id_log = ?', [$id_log])
            ->update(['jumlah_mhs_hadir_log' => $request->input('jumlah_mhs_hadir_log')]);

        // return redirect()->route('pages.admin.log-perkuliahan.index',[
        //     'items' => $items
        // ]);
        return redirect()->route('log-perkuliahan.index',[
            'items' => $items
        ]);
    }
}
