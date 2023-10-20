<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 5;
        if ($request->has('search')) {
            $items = DB::table('mahasiswa')
                ->select('*')
                ->join('users', 'users.id', '=', 'mahasiswa.id_dosen')
                ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
                ->where('mahasiswa.deleted_at', NULL)
                ->where('mahasiswa.nama_mahasiswa', 'LIKE', '%' . $request->search . '%')
                ->simplePaginate($pagination);
        } else {
            $items = DB::table('mahasiswa')
                ->select('*')
                ->join('users', 'users.id', '=', 'mahasiswa.id_dosen')
                ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi')
                ->where('mahasiswa.deleted_at', NULL)
                ->simplePaginate($pagination);
        }

        return view('pages.admin.mahasiswa.index', [
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
        $user = User::where('profesi', 'Dosen')->get();
        $prodi = Prodi::all();
        return view('pages.admin.mahasiswa.create', [
            'user' => $user,
            'prodi' => $prodi
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        // Mahasiswa::create($data);

        $this->validate($request, [
            'nim_mahasiswa' => 'required|max:225',
            'nama_mahasiswa' => 'required|max:225',
            'id_prodi' => 'required|max:225',
            'tahun_masuk' => 'required|max:225',
            'id_dosen' => 'required|max:225',
            'email_mahasiswa' => 'required|max:225',
            'password_mahasiswa' => 'required|max:225',
        ]);

        DB::table('mahasiswa')->insert([
            'nim_mahasiswa' => $request->nim_mahasiswa,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'id_prodi' => $request->id_prodi,
            'tahun_masuk' => $request->tahun_masuk,
            'id_dosen' => $request->id_dosen,
            'email_mahasiswa' => $request->email_mahasiswa,
            'password_mahasiswa' => md5($request->password_mahasiswa),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim_mahasiswa)
    {
        $item = Mahasiswa::where('nim_mahasiswa', $nim_mahasiswa)->first();
        $prodi = Prodi::all();
        $user = User::where('profesi', 'Dosen')->get();

        return view('pages.admin.mahasiswa.edit', [
            'item' => $item,
            'prodi' => $prodi,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $nim_mahasiswa)
    {
        $this->validate($data, [
            'nim_mahasiswa' => ['required', 'string', 'max:255'],
            'nama_mahasiswa' => ['required', 'string', 'max:255'],
            'id_prodi' => ['required'],
            'tahun_masuk' => ['required'],
            'id_dosen' => ['required'],
            'email_mahasiswa' => ['required', 'string', 'email', 'max:255',],
            'password' => $data->password != null ? ['sometimes', 'confirmed', 'min:5', 'same:password'] : '',
        ]);
        if ($data['password'] !== NULL) {
            Mahasiswa::find($data->nim_mahasiswa)->update([
                'password_mahasiswa' => md5($data['password']),
            ]);
        }

        DB::table('mahasiswa')
            ->where('nim_mahasiswa', $nim_mahasiswa)
            ->update([
                'nim_mahasiswa' => $data['nim_mahasiswa'],
                'nama_mahasiswa' => $data['nama_mahasiswa'],
                'id_prodi' => $data['id_prodi'],
                'tahun_masuk' => $data['tahun_masuk'],
                'id_dosen' => $data['id_dosen'],
                'email_mahasiswa' => $data['email_mahasiswa']
            ]);

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim_mahasiswa)
    {
        // $item = Mahasiswa::findOrFail($nim_mahasiswa);
        // $item->delete();

        DB::table('mahasiswa')
            ->where('nim_mahasiswa', $nim_mahasiswa)
            ->update(['deleted_at' => Carbon::now()]);

        return redirect()->route('mahasiswa.index');
    }
}
