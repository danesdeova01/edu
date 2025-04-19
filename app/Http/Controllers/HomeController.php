<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\Tugas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // Cek apakah pengguna sudah login
    if (!\Auth::check()) {
        return redirect()->route('login'); // Arahkan ke halaman login jika belum login
    }

    // Cek level pengguna
    $user = \Auth::user(); // Mendapatkan data pengguna yang sedang login

    if ($user->level === 'admin') {
        // Jika level pengguna adalah admin, tampilkan halaman home admin
        return view('home', [
            'menuActive'   => 'home',
            'total_materi' => MataPelajaran::count(),
            'total_topik'  => Materi::count(),
            'total_kuis'   => Soal::count(),
            'total_tugas'  => Tugas::count(),
        ]);
    } elseif ($user->level === 'mahasiswa') {
        // Jika level pengguna adalah mahasiswa, arahkan ke halaman utama (/)
        return redirect()->route('welcome'); // Atau tampilkan halaman yang sesuai untuk mahasiswa
    } else {
        // Handle level lainnya (opsional)
        return redirect()->route('welcome'); // Atau tampilkan pesan error
    }
    }
}
