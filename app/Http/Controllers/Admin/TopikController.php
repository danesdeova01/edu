<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class TopikController extends Controller
{
    public function index()
    {
        $topiks = Topik::with('mataPelajaran', 'kelas')->latest()->get();

        return view('admin.topik.index', [
            'menuActive' => 'topik',
            'topiks' => $topiks,
        ]);
    }

    public function create()
    {
        return view('admin.topik.form', [
            'menuActive' => 'topik',
            'isEdit' => false,
            'url' => route('admin.topik.store'),
            'mata_pelajarans' => MataPelajaran::latest()->get(),
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'matapelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:25000',
        ]);

        try {
            $fileName = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                // Bersihkan nama file dan tambahkan timestamp agar unik
                $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                // Simpan file di storage/app/public/materi/file
                $file->storeAs('public/materi/file', $fileName);
            }

            Topik::create([
                'nama' => $validated['nama'],
                'matapelajaran_id' => $validated['matapelajaran_id'],
                'kelas_id' => $validated['kelas_id'],
                'konten' => $validated['konten'] ?? null,
                'file' => $fileName,
            ]);

            Alert::success('Berhasil', 'Topik berhasil ditambahkan');
            return redirect()->route('admin.topik.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $topik = Topik::findOrFail($id);

        return view('admin.topik.form', [
            'menuActive' => 'topik',
            'isEdit' => true,
            'url' => route('admin.topik.update', $id),
            'mata_pelajarans' => MataPelajaran::latest()->get(),
            'kelas' => Kelas::all(),
            'data' => $topik,
        ]);
    }

    public function update(Request $request, $id)
    {
        $topik = Topik::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'matapelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'konten' => 'nullable|string',
            'file' => 'nullable|file|max:25000',
        ]);

        try {
            $fileName = $topik->file;
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($topik->file) {
                    Storage::delete('public/materi/file/' . $topik->file);
                }
                $file = $request->file('file');
                $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->storeAs('public/materi/file', $fileName);
            }

            $topik->update([
                'nama' => $validated['nama'],
                'matapelajaran_id' => $validated['matapelajaran_id'],
                'kelas_id' => $validated['kelas_id'],
                'konten' => $validated['konten'] ?? null,
                'file' => $fileName,
            ]);

            Alert::success('Berhasil', 'Topik berhasil diperbarui');
            return redirect()->route('admin.topik.index');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $topik = Topik::findOrFail($id);

        if ($topik->file) {
            Storage::delete('public/materi/file/' . $topik->file);
        }

        $topik->delete();

        Alert::success('Berhasil', 'Topik berhasil dihapus');
        return redirect()->route('admin.topik.index');
    }
}
