<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{

    protected $table = 'siswa'; // pastikan nama tabel benar

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
