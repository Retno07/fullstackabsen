<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProdiRequest;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdiController extends Controller
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
            $items = Prodi::where('nama_prodi','LIKE','%' .$request->search.'%')->simplePaginate($pagination);
        }else {
            $items = Prodi::simplePaginate($pagination);
        }

        return view('pages.admin.prodi.index',[
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

        return view('pages.admin.prodi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdiRequest $request)
    {
        $data = $request->all();
        Prodi::create($data);
        
        return redirect()->route('prodi.index');
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
    public function edit($id)
    {
        $item = Prodi::findOrFail($id);

        return view('pages.admin.prodi.edit',[
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdiRequest $request, $id)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);
        
        $item = Prodi::findOrFail($id);

        $item->update($data);

        return redirect()->route('prodi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Prodi::findOrFail($id);
        $item->delete();

        return redirect()->route('prodi.index');
    }
}
