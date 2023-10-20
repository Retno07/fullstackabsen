<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MakulRequest;
use App\Models\Makul;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MakulController extends Controller
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
            $items = Makul::where('nama_mata_kuliah','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = Makul::simplePaginate($pagination);
        }

        return view('pages.admin.makul.index',[
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
        $prodi = Prodi::all();

        return view('pages.admin.makul.create',[
            'prodi' => $prodi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MakulRequest $request)
    {
        $this->validate($request, [
            'id_prodi' => 'required',
            'nama_mata_kuliah' => 'required',
            'sks_mata_kuliah' => 'required',
            'semester_mata_kuliah' => 'required',
        ]);

        // Decoding array input makul
        if (isset($request->id_mata_kuliah)) {
            $id_mata_kuliah = $request->id_mata_kuliah;
        } else {
            $id_mata_kuliah = "";
        }

        DB::table('mata_kuliah')->insert([
            'id_prodi' => $request->id_prodi,
            'nama_mata_kuliah' => $request->nama_mata_kuliah,
            'sks_mata_kuliah' => $request->sks_mata_kuliah,
            'semester_mata_kuliah' => $request->semester_mata_kuliah,
            'id_mata_kuliah' => $id_mata_kuliah,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // $data = $request->all();
        // Makul::create($data);

        return redirect()->route('makul.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Makul::findOrFail($id);

        return view('pages.admin.makul.detail',[
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Makul::findOrFail($id);
        $prodi = Prodi::all();

        return view('pages.admin.makul.edit',[
            'item' => $item,
            'prodi' => $prodi
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
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        $item = Makul::findOrFail($id);

        $item->update($data);

        return redirect()->route('makul.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Makul::findOrFail($id);
        $item->delete();

        return redirect()->route('makul.index');
    }
}
