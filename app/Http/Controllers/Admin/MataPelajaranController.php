<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.matapelajaran.index', [
            'menuActive'     => 'materi',
            'matapelajarans' => MataPelajaran::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.matapelajaran.form', [
            'menuActive' => 'materi',
            'isEdit'     => false,
            'url'        => url('admin/materi'),
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
        MataPelajaran::create([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        Alert::success('Berhasil', ucwords('data materi telah ditambahkan'));

        return redirect('admin/materi');
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
        return view('admin.matapelajaran.form', [
            'menuActive' => 'materi',
            'isEdit'     => true,
            'url'        => url('admin/materi/' . $id),
            'data'       => MataPelajaran::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        MataPelajaran::find($id)->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
        ]);

        Alert::warning('Berhasil', ucwords('data materi telah diperbarui'));

        return redirect('admin/materi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MataPelajaran::find($id)->delete();
        Alert::error('Berhasil', ucwords('data materi telah dihapus'));
        return redirect('admin/materi');
    }
}
