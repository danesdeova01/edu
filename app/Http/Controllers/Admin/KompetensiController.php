<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.kompetensi.index', [
        //     'menuActive'     => 'kompetensi',
        //     'kompetensis' => Kompetensi::latest()->get(),
        // ]);

        return view('admin.kompetensi.form', [
            'menuActive' => 'kompetensi',
            'isEdit'     => false,
            'data'       => Kompetensi::first(),
            'url'        => url('admin/kompetensi'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kompetensi.form', [
            'menuActive' => 'kompetensi',
            'isEdit'     => false,
            'url'        => url('admin/kompetensi'),
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
        // Kompetensi::create([
        //     'judul'     => $request->judul,
        //     'deskripsi' => $request->deskripsi,
        // ]);

        Kompetensi::first()->update([
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::warning('Berhasil', ucwords('data kompetensi telah diperbarui'));

        return redirect('admin/kompetensi');
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
        return view('admin.kompetensi.form', [
            'menuActive' => 'kompetensi',
            'isEdit'     => true,
            'url'        => url('admin/kompetensi/' . $id),
            'data'       => Kompetensi::find($id),
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
        Kompetensi::find($id)->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        Alert::warning('Berhasil', ucwords('data kompetensi telah diperbarui'));

        return redirect('admin/kompetensi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kompetensi::find($id)->delete();
        Alert::error('Berhasil', ucwords('data kompetensi telah dihapus'));
        return redirect('admin/kompetensi');
    }
}
