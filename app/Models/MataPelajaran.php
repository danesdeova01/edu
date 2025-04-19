<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function materis()
    {
        return $this->hasMany('App\Models\Materi', 'matapelajaran_id');
    }

    public function tugas()
    {
        return $this->hasMany('App\Models\Tugas', 'tugas_id');
    }
}
