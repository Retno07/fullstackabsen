<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Admin\LogBookRequest;
use App\Models\LogPerkuliahan;
use Auth;
use App\Models\Absen;
// use App\Models\User;
// use App\Models\Kelas;
// use App\Models\Makul;
// use App\Models\ThnAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogPerkuliahanController extends Controller
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
            $items = DB::table('log')
            ->select('*')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->where('id_dosen_identity', Auth::user()->id)
            ->where('log.deleted_at', NULL)
            ->where('nama_mata_kuliah','LIKE','%' .$request->search.'%')
            ->orderby('pertemuan_log', 'DESC')->simplePaginate($pagination);
        }else {
            $items = DB::table('log')
            ->select('*')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->where('id_dosen_identity', Auth::user()->id)
            ->where('log.deleted_at', NULL)
            ->orderby('pertemuan_log', 'DESC')->simplePaginate($pagination);
        }

        return view('pages.admin.log-perkuliahan.index',[
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

        return view('pages.admin.log-book.create',[
            'users' => $users,
            'prodi' => $prodi,
            'kelas' => $kelas,
            'tahun' => $tahun
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
        $data = $request->all();
        LogBook::create($data);

        return redirect()->route('log-book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_log)
    {
        ///
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_log)
    {
        $items = LogPerkuliahan::findOrFail($id_log);

        return view('pages.admin.log-perkuliahan.edit',[
            'items' => $items
        ]);
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
        $item = LogPerkuliahan::findOrFail($id);
        $item->delete();

        return redirect()->route('log-perkuliahan.index');
    }

    public function lihat_absen_detail(Request $request,$id_log)
    {
        $pagination = 5;
        if($request->has('search')){
            $items = DB::table('absen')
            ->select('*')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->whereRaw('id_log_absen = ?', [$id_log])
            ->where('nama_mahasiswa','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DB::table('absen')
            ->select('*')
            ->join('mahasiswa', 'mahasiswa.nim_mahasiswa', '=', 'absen.nim_mahasiswa_absen')
            ->whereRaw('id_log_absen = ?', [$id_log])
            ->simplePaginate($pagination);
        }

        return view('pages.admin.log-perkuliahan.detail',[
            'items' => $items
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
}
