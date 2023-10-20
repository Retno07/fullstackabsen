<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\LogBook;
use App\Models\User;
use App\Models\LogAbsen;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::where('deleted_at', NULL)->count();
        $makul = LogBook::where('deleted_at', NULL)->count();
        $dosen = User::where('profesi', 'Dosen')->count();
        $staff = User::where('profesi', 'Staff')->count();

        $pagination = 5;
        if($request->has('search')){
            $items = DB::table('log')
            ->select('*')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->where('log.deleted_at', NULL)
            ->where('log.log_is_verif', 0)
            ->where('log.jumlah_mhs_hadir_log', '!=' ,0)
            ->where('nama_mata_kuliah','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = DB::table('log')
            ->select('*')
            ->join('identity_log_book', 'identity_log_book.id_identity', '=', 'log.id_identity_log')
            ->join('users', 'users.id', '=', 'identity_log_book.id_dosen_identity')
            ->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah', '=', 'identity_log_book.id_makul_group')
            ->join('kelas', 'kelas.id_kelas', '=', 'identity_log_book.id_kelas_identity')
            ->join('ruang', 'ruang.id_ruang', '=', 'log.id_ruang_log')
            ->where('log.deleted_at', NULL)
            ->where('log.log_is_verif', 0)
            ->where('log.jumlah_mhs_hadir_log', '!=' ,0)
            ->simplePaginate($pagination);
        }

        return view('pages.admin.dashboard', [
            'mahasiswa' => $mahasiswa,
            'makul' => $makul,
            'dosen' => $dosen,
            'staff' => $staff,
            'items' => $items
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function verifikasi_log(Request $request, $id_log)
    {
        $items = DB::table('log')
            ->where('id_log',$id_log)
            ->update(['log_is_verif' => 1]);

        return redirect()->route('dashboard.index',[
            'items' => $items
        ]);
    }
}
