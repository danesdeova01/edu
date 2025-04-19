<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function jawabans()
    {
        return $this->hasMany('App\Models\Jawaban');
    }

    public function matapelajaran()
    {
        return $this->belongsTo('App\Models\MataPelajaran');
    }
}
