<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Soal;
use App\Models\Topik;
use App\Models\JenisUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class SoalController extends Controller
{
    public function index()
    {
        return view('admin.soal.index', [
            'menuActive'   => 'kuis',
            'soals'        => Soal::with('materi')->latest()->get(),
            'jenisUjian'   => JenisUjian::all(),
        ]);
    }
    public function updateJenisUjianTimer(Request $request)
    {
        foreach ($request->timer as $id => $value) {
            JenisUjian::where('id', $id)->update(['timer' => $value]);
        }

        Alert::success('Berhasil', 'Timer berhasil diperbarui');
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.soal.form', [
            'menuActive' => 'kuis',
            'isEdit'     => false,
            'url'        => url('admin/kuis'),
            'mata_pelajarans' => Topik::all()
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
        $jenisSoal = $request->input('jenis_soal');
        $jenisUjian = $request->input('jenis_ujian');  // Get

        $soal = new Soal();

        $soal->pertanyaan = $request->input('pertanyaan');
        $soal->materi_id = $request->input('topik');
        $soal->jenis_soal = $jenisSoal;
        $soal->jenis_ujian = $jenisUjian;


        if ($jenisSoal == 'menjodohkan') {
            $soal->pencocokan = $request->input('menjodohkan') ?? 'cocok';
        } else if ($jenisSoal == 'pilihan_ganda') {
            $soal->pilihan_a = $request->pilihan_a;
            $soal->pilihan_b = $request->pilihan_b;
            $soal->pilihan_c = $request->pilihan_c;
            $soal->pilihan_d = $request->pilihan_d;
            $soal->pilihan_e = $request->pilihan_e;
            $soal->kunci_jawaban = $request->kunci_jawaban;
        } else if ($jenisSoal == 'pilihan_ganda_kompleks') {
            $soal->pilihan_a = $request->pilihan_a;
            $soal->pilihan_b = $request->pilihan_b;
            $soal->pilihan_c = $request->pilihan_c;
            $soal->pilihan_d = $request->pilihan_d;
            $soal->pilihan_e = $request->pilihan_e;
            $soal->kunci_jawaban = json_encode($request->input('kunci_jawaban', []));
        } else if ($jenisSoal == 'uraian_singkat') {
            $soal->uraian = $request->jawaban_uraian;
        }

        $soal->save();

        Alert::success('Berhasil', ucwords('data latihan kuis telah ditambahkan'));

        // Redirect ke halaman kuis admin
        return redirect('admin/kuis');
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
        return view('admin.soal.form', [
            'menuActive' => 'kuis',
            'isEdit'     => true,
            'url'        => url('admin/kuis/' . $id),
            'data'       => Soal::find($id),
            'mata_pelajarans' => MataPelajaran::all()
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
        // Mencari soal berdasarkan ID
        $soal = Soal::findOrFail($id);
        $jenisUjian = $request->input('jenis_ujian');  // Get









        // Menentukan jenis soal
        $jenisSoal = $request->input('jenis_soal');

        // Memperbarui data soal
        $soal->pertanyaan = $request->input('pertanyaan');
        $soal->materi_id = $request->input('topik');
        $soal->jenis_soal = $jenisSoal;
        $soal->jenis_ujian = $jenisUjian;

        // Menangani soal menjodohkan
        if ($jenisSoal == 'menjodohkan') {
            $soal->pencocokan = $request->input('menjodohkan') ?? 'cocok';
        }
        // Menangani soal pilihan ganda
        else if ($jenisSoal == 'pilihan_ganda') {
            $soal->pilihan_a = $request->pilihan_a;
            $soal->pilihan_b = $request->pilihan_b;
            $soal->pilihan_c = $request->pilihan_c;
            $soal->pilihan_d = $request->pilihan_d;
            $soal->pilihan_e = $request->pilihan_e;
            $soal->kunci_jawaban = $request->kunci_jawaban;
        } else if ($jenisSoal == 'pilihan_ganda_kompleks') {
            $soal->pilihan_a = $request->pilihan_a;
            $soal->pilihan_b = $request->pilihan_b;
            $soal->pilihan_c = $request->pilihan_c;
            $soal->pilihan_d = $request->pilihan_d;
            $soal->pilihan_e = $request->pilihan_e;
            $soal->kunci_jawaban = json_encode($request->input('kunci_jawaban', []));
        } else if ($jenisSoal == 'uraian_singkat') {
            $soal->uraian = $request->jawaban_uraian;
        }

        $soal->save();

        Alert::success('Berhasil', ucwords('data latihan kuis telah diperbarui'));

        return redirect('admin/kuis');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Soal::find($id)->delete();
        Alert::error('Berhasil', ucwords('data latihan kuis telah dihapus'));
        return redirect('admin/kuis');
    }
}
