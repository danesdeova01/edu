<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tugas.index', [
            'menuActive' => 'tugas',
            'tugas'      => Tugas::with('jawabans', 'matapelajaran')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tugas.form', [
            'menuActive'    => 'tugas',
            'isEdit'        => false,
            'url'           => url('admin/tugas'),
            'matapelajaran' => MataPelajaran::latest()->get(),
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
        $file     = $request->file('file');
        $namaFile = null;

        if ($file != null) {
            $namaFile = $file->getClientOriginalName();
            Storage::putFileAs('/tugas/file/', $file, $namaFile);
        }

        Tugas::create([
            'konten'           => $request->konten,
            'matapelajaran_id' => $request->matapelajaran_id,
            'file'             => $namaFile,
        ]);

        Alert::success('Berhasil', ucwords('data tugas telah ditambahkan'));

        return redirect('admin/tugas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.tugas.detail', [
            'menuActive' => 'tugas',
            'tugas'      => Tugas::find($id),
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
        return view('admin.tugas.form', [
            'menuActive'    => 'tugas',
            'isEdit'        => true,
            'url'           => url('admin/tugas/' . $id),
            'matapelajaran' => MataPelajaran::latest()->get(),
            'data'          => Tugas::find($id),
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

        $tugas   = Tugas::find($id);
        $file     = $request->file('file');
        $namaFile = $tugas->file;

        if ($file != null) {
            # delete
            Storage::delete('/tugas/file/' . $tugas->file);

            $namaFile = $file->getClientOriginalName();
            Storage::putFileAs('/tugas/file/', $file, $namaFile);
        }

        $tugas->update([
            'konten'           => $request->konten,
            'matapelajaran_id' => $request->matapelajaran_id,
            'file'             => $namaFile,
        ]);

        Alert::warning('Berhasil', ucwords('data tugas telah diperbarui'));

        return redirect('admin/tugas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tugas   = Tugas::find($id);

        Storage::delete('/tugas/file/' . $tugas->file);

        $tugas->delete();
        Alert::error('Berhasil', ucwords('data tugas telah dihapus'));
        return redirect('admin/tugas');
    }
}
