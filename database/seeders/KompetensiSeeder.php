<?php

namespace Database\Seeders;

use App\Models\Kompetensi;
use Illuminate\Database\Seeder;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kompetensi::create([
            'judul'     => 'Halaman Kompetensi',
            'deskripsi' => 'ini adalah deskripsi kompetensi'
        ]);
    }
}
