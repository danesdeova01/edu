<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/kompetensi', [App\Http\Controllers\WebController::class, 'kompetensi']);
Route::get('/materi', [App\Http\Controllers\WebController::class, 'matapelajaran']);
Route::get('/materi/{id}', [App\Http\Controllers\WebController::class, 'matpelDetail']);
Route::get('/topik/{id}', [App\Http\Controllers\WebController::class, 'topik']);
Route::get('/kuis', [App\Http\Controllers\WebController::class, 'latihansoal']);
Route::post('/kuis', [App\Http\Controllers\WebController::class, 'submitLatihan']);
Route::get('/kirimtugas', [App\Http\Controllers\WebController::class, 'kirimtugas']);
Route::get('/kirimtugas/submit/{id}', [App\Http\Controllers\WebController::class, 'kirimtugasForm']);
Route::post('/kirimtugas/submit/{id}', [App\Http\Controllers\WebController::class, 'kirimtugasSubmit']);

Auth::routes([
    'register' => false,
    'reset'    => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\WebController::class, 'index'])->name('welcome');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::get('/admin/setting', [App\Http\Controllers\SettingController::class, 'index']);

    Route::post('/admin/setting', [App\Http\Controllers\SettingController::class, 'update']);

    Route::resource('/admin/materi', App\Http\Controllers\Admin\MataPelajaranController::class)
        ->except('show');

    Route::resource('/admin/kompetensi', App\Http\Controllers\Admin\KompetensiController::class)
        ->only(['index', 'store']);

    Route::resource('/admin/topik', App\Http\Controllers\Admin\MateriController::class)
        ->except('show');

    Route::resource('/admin/kuis', App\Http\Controllers\Admin\SoalController::class)
        ->except('show');

    Route::resource('/admin/tugas', App\Http\Controllers\Admin\TugasController::class);
    Route::resource('admin/forum', App\Http\Controllers\Admin\ForumController::class);
    Route::post('admin/forum/{forum}/reply', [App\Http\Controllers\Admin\ForumReplyController::class, 'store'])->name('forum.reply.store');
    
});
