<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\MataPelajaran;
use App\Models\JenisUjian;
use App\Models\Soal;
use App\Models\Tugas;
use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\Kelas;
use App\Models\Topik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }

        return view('welcome', [
            'menuActive' => 'beranda',
            'mata_pelajarans'    => MataPelajaran::with('kelas')->latest()->limit(9)->get(),
        ]);
    }

    public function pilihKelas()
    {
        $kelas = Kelas::all();
        return view('matapelajaran-kelas', compact('kelas'));
    }

    // Daftar mata pelajaran per kelas
    public function showMatapelajaran($kelas)
    {
        $kelasModel = Kelas::where('slug', $kelas)->orWhere('id', $kelas)->firstOrFail();

        // Ambil mata pelajaran yang terkait dengan kelas ini melalui relasi many-to-many
        $mata_pelajarans = $kelasModel->mataPelajarans()->get();

        return view('matapelajaran-show', [
            'kelas' => $kelasModel,
            'mata_pelajarans' => $mata_pelajarans,
        ]);
    }

    public function matapelajaran()
    {
        return view('matapelajaran', [
            'menuActive'     => 'matapelajaran',
            'matapelajarans' => MataPelajaran::with('mata_pelajarans')->latest()->get(),
        ]);
    }

    public function matpelDetail($matapelajaranId, Request $request)
    {
        $kelasId = $request->kelas ?? $request->kelas_id ?? null;
        $matapelajaran = MataPelajaran::findOrFail($matapelajaranId);
        $kelas = null;
        $topiks = collect();

        if ($kelasId) {
            $kelas = Kelas::where('slug', $kelasId)->orWhere('id', $kelasId)->first();
            $topiks = \App\Models\Topik::where('matapelajaran_id', $matapelajaran->id)
                ->where('kelas_id', $kelas->id)
                ->get();
        }

        return view('matapelajaran-detail', [
            'menuActive'    => 'matapelajaran',
            'matapelajaran' => $matapelajaran,
            'kelas'         => $kelas,
            'topiks'        => $topiks,
        ]);
    }
    public function topik($id)
    {
        $topik = Topik::findOrFail($id);
        return view('topik', compact('topik'));
    }

    public function latihanSoalBefore()
    {
        $user = Auth::user();
        if (isset($user->kelas_id)) {
            $kelasId = $user->kelas_id;
            $mapels = MataPelajaran::whereHas('kelas', function ($query) use ($kelasId) {
                $query->where('kelas.id', $kelasId);
            })->get();
            return view('latihanSoalBefore', compact('mapels'));
        } else {
            return redirect()->to('/')->with('error', 'Ops, silahkan anda meminta admin untuk memberikan kelas anda');
        }
    }

    // Pilih kelas
    public function tugasPilihKelas()
    {
        $kelas = \App\Models\Kelas::all();
        return view('tugas-pilih-kelas', compact('kelas'));
    }

    // Pilih mata pelajaran berdasarkan kelas
    public function tugasPilihMapel($kelasId)
    {
        $kelas = \App\Models\Kelas::findOrFail($kelasId);
        $mata_pelajarans = $kelas->mataPelajarans; // relasi many-to-many
        return view('tugas-pilih-mapel', compact('kelas', 'mata_pelajarans'));
    }

    // Daftar tugas berdasarkan mata pelajaran
    public function tugasDaftar($kelasId, $mapelId)
    {
        $kelas = \App\Models\Kelas::findOrFail($kelasId);
        $mapel = \App\Models\MataPelajaran::findOrFail($mapelId);

        // Filter tugas berdasarkan kelas dan mata pelajaran
        $tugas = \App\Models\Tugas::where('matapelajaran_id', $mapelId)
            ->where('kelas_id', $kelasId)
            ->latest()
            ->get();

        $now = Carbon::now();

        return view('kirimtugas', compact('kelas', 'mapel', 'tugas'));
    }

    public function downloadMateriFile($filename)
    {
        $filePath = 'materi/file/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function downloadTugasFile($filename)
    {
        $filePath = 'tugas/file/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($filePath);
    }

    public function downloadJawabanFile($filename)
    {
        $filePath = 'jawaban/file/' . $filename;

        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($filePath);
    }
    public function latihanSoalTipe($id)
    {
        return view('tipe-ujian', [
            'mapel_id' => $id
        ]);
    }
    public function latihansoal(Request $request, $id)
    {
        $user = Auth::user();

        $tipe = $request->query('tipe');

        if (!isset($tipe)) {
            return redirect()->route('latihan.soal.tipe', ['id' => $id])
                ->with('error', 'Ops, harap pilih jenis UJIAN');
        }

        if (isset($user->kelas_id)) {

            $kelas = Kelas::with('mataPelajarans')->where('id', $id)->first();

            if (!$kelas) {
                return abort(404, "Kelas tidak ditemukan");
            }

            $topikIds = Topik::where('matapelajaran_id', $id)
                ->where('kelas_id', $user->kelas_id)
                ->pluck('id')
                ->toArray();

            $soals = Soal::whereIn('materi_id', $topikIds)
                ->where('jenis_ujian', $tipe)
                ->get()
                ->map(function ($soal) {
                    if ($soal->jenis_soal === 'menjodohkan' && $soal->pencocokan) {
                        $decoded = json_decode($soal->pencocokan, true);

                        if (is_array($decoded)) {
                            $soal->pencocokan_items = $decoded;
                        } else {
                            $soal->pencocokan_items = [];
                        }
                    }

                    return $soal;
                });
            $optionMenjodohkan = $soals
                ->where('jenis_soal', 'menjodohkan')
                ->pluck('pencocokan')
                ->filter()
                ->shuffle()
                ->values()
                ->toArray();
            // dd($soals);

            return view('latihansoal', [
                'menuActive' => 'kuis',
                'soals' => $soals,
                'jenisUjian' => JenisUjian::where('nama', $tipe)->first(),
                'optionMenjodohkan' => $optionMenjodohkan
            ]);
        } else {
            return redirect()->to('/')
                ->with('error', 'Ops, kamu belum memiliki kelas. Silakan meminta admin untuk memberikan kamu kelas terlebih dahulu!');
        }
    }

    public function submitLatihan(Request $request)
    {
        $pilihan    = $request->pilihan;
        $uraian     = $request->uraian;
        $menjodohkan = $request->menjodohkan;
        $id_soal    = $request->id;
        $jumlah     = $request->jumlah;

        $score = 0;
        $benar = 0;
        $salah = 0;
        $kosong = 0;

        for ($i = 0; $i < $jumlah; $i++) {
            $nomor = $id_soal[$i];
            $soal = Soal::find($nomor);

            // Periksa jenis soal dan jawaban yang sesuai
            if ($soal->jenis_soal == 'pilihan_ganda') {
                if (empty($pilihan[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $pilihan[$nomor];

                    $where = array(
                        'id' => $nomor,
                        'kunci_jawaban' => $jawaban,
                    );
                    $cek = Soal::where($where)->count();
                    if ($cek == 1) {
                        $benar++;
                    } else {
                        $salah++;
                    }
                }
            } elseif ($soal->jenis_soal == 'uraian_singkat') {
                if (empty($uraian[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $uraian[$nomor];
                    if (strtolower(trim($jawaban)) == strtolower(trim($soal->uraian))) {
                        $benar++;
                    } else {
                        $salah++;
                    }
                }
            } elseif ($soal->jenis_soal == 'pilihan_ganda_kompleks') {
                if (empty($pilihan[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $pilihan[$nomor];
                    $cleaned_kunci_jawaban = str_replace(['[', ']', ' '], '', $soal->kunci_jawaban);

                    $correct_answers = explode(',', $cleaned_kunci_jawaban); // Assuming answers are stored comma-separated

                    sort($jawaban);
                    sort($correct_answers);

                    $jawaban = array_map(function ($item) {
                        return trim($item, '"');
                    }, $jawaban);

                    $correct_answers = array_map(function ($item) {
                        return trim($item, '"');
                    }, $correct_answers);

                    if ($jawaban == $correct_answers) {
                        $benar++;
                    } else {
                        $salah++;
                    }
                }
            } elseif ($soal->jenis_soal == 'menjodohkan') {
                if (empty($menjodohkan[$nomor])) {
                    $kosong++;
                } else {
                    $jawaban = $menjodohkan[$nomor];

                    $pairs = explode(';', $jawaban);
                    $jawaban_pairs = [];

                    foreach ($pairs as $pair) {
                        $split = explode('=', $pair);
                        if (count($split) === 2) {
                            $key = trim($split[0]);
                            $value = trim($split[1]);
                            $jawaban_pairs[$key] = $value;
                        }
                    }

                    $correct_pairs = unserialize($soal->kunci_jawaban);

                    $is_correct = true;
                    foreach ($jawaban_pairs as $key => $value) {
                        if (!isset($correct_pairs[$key]) || $correct_pairs[$key] !== $value) {
                            $is_correct = false;
                            break;
                        }
                    }

                    if ($is_correct) {
                        $benar++;
                    } else {
                        $salah++;
                    }
                }
            }
        }

        $score = 100 / $jumlah * $benar;

        $text = 'Score: ' . $score . ', Benar: ' . $benar . ', Salah: ' . $salah . ', Kosong: ' . $kosong;

        if ($score >= 75) {
            Alert::success('Baik', $text);
        }

        if ($score <= 74.9 && $score >= 50) {
            Alert::warning('Cukup', $text);
        }

        if ($score <= 49.5) {
            Alert::error('Tidak Lulus', $text);
        }

        return redirect()->back();
    }


    public function kirimtugas()
    {
        $user = auth()->user();

        // Ambil tugas yang sesuai kelas dan mata pelajaran
        $tugas = Tugas::where('kelas_id', $kelasId)->latest()->get();

        return view('kirimtugas', [
            'menuActive' => 'kirim-tugas',
            'tugas'      => $tugas,
        ]);
    }

    public function kirimtugasForm($id)
    {
        return view('kirimtugas-submit', [
            'menuActive' => 'kirim-tugas',
            'tugas'      => Tugas::find($id),
        ]);
    }

    public function kirimtugasSubmit(Request $request, $id)
    {
        $file = $request->file('file');
        $namaFile = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

        $file->storeAs('jawaban/file', $namaFile, 'public');

        Jawaban::create([
            'tugas_id'   => $id,
            'nama'       => $request->nama,
            'no_induk'   => $request->no_induk,
            'file_jawab' => $namaFile,
            'user_id' => auth()->id()
        ]);

        Alert::success('Berhasil', ucwords('Submit tugas Anda telah berhasil'));

        return redirect('kirimtugas');
    }

    public function forum()
    {
        return view('forum', [
            'menuActive' => 'forum',
            'forums' => Forum::withCount('replies')->latest()->get(),
        ]);
    }

    public function forumDetail($id)
    {
        return view('forum-detail', [
            'menuActive' => 'forum',
            'forum'      => Forum::find($id),
        ]);
    }

    public function forumReply(Request $request, $id)
    {
        $request->validate([
            'konten' => 'required|string',
        ]);

        ForumReply::create([
            'forum_id' => $id,
            'user_id' => auth()->id(),
            'konten' => $request->konten,
        ]);

        Alert::success('Berhasil', ucwords('Balasan berhasil dikirim'));

        return redirect()->back();
    }


    public function riwayatSubmit()
    {

        $jawabans = Jawaban::where('user_id', auth()->id())->with('tugas', 'review', 'tugas.matapelajaran')->get();
        return view('riwayat', compact('jawabans'));
    }
}
