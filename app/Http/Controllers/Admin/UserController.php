<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
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
            $items = User::where('profesi', 'dosen')->where('name', 'LIKE', '%' . $request->search . '%')->simplePaginate($pagination);
        } else {
            $items = User::where('profesi', 'dosen')->simplePaginate($pagination);
        }

        return view('pages.admin.pengguna.index', [
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
        return view('pages.admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $data['slug'] = Str::slug($request->title);

        User::create($data);
        return redirect()->route('pengguna.index');
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
        // $item = User::findOrFail($id);

        // return view('pages.admin.pengguna.edit',[
        //     'item' => $item
        // ]);

        $item = User::where('id', $id)->first();
        return view('pages.admin.pengguna.edit', [
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
    public function update(Request $data, $id)
    {
        // $data = $request->all();
        // $item = User::findOrFail($id);
        // $item->update($data);
        $this->validate($data, [
            'nomor_induk' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($data->id),],
            'password' => $data->password != null ? ['sometimes', 'confirmed', 'min:8', 'same:password'] : '',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($data->id),],
            'profesi' => ['required', 'string', 'max:255'],
        ]);
        if ($data['password'] !== NULL) {
            User::find($data->id)->update([
                'password' => Hash::make($data['password']),
            ]);
        }
        User::find($data->id)->update([
            'nomor_induk' => $data['nomor_induk'],
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'profesi' => $data['profesi'],


        ]);
        if ($data['admin'] !== NULL) {
            User::find($data->id)->update([
                'admin' => $data['admin'],
            ]);
        }
        if (Auth::user()->roles == 1) {
            return redirect()->route('pengguna.index');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('pengguna.index');
    }
}
