<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TugasAkhirController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route Dosen
Route::get('/data_dosen',[DosenController::class,'dosen'])->middleware(['auth', 'verified'])->name('dosen.data');
Route::get('/dosen',[DosenController::class,'index'])->middleware(['auth', 'verified'])->name('dosen');
Route::get('/dosen/create',[DosenController::class,'create'])->middleware(['auth', 'verified'])->name('dosen.create');
Route::post('/dosen',[DosenController::class,'store'])->middleware(['auth', 'verified'])->name('dosen.store');
Route::get('/dosen/{id}/edit',[DosenController::class,'edit'])->middleware(['auth', 'verified'])->name('dosen.edit');
Route::put('/dosen/{id}',[DosenController::class,'update'])->middleware(['auth', 'verified'])->name('dosen.update');
Route::delete('/dosen/{id}',[DosenController::class,'destroy'])->middleware(['auth', 'verified'])->name('dosen.destroy');

//Route Mahasiswa
Route::get('/data_mahasiswa', [MahasiswaController::class, 'mahasiswa'])->middleware(['auth', 'verified'])->name('mahasiswa.data');
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->middleware(['auth', 'verified'])->name('mahasiswa');
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->middleware(['auth', 'verified'])->name('mahasiswa.create');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->middleware(['auth', 'verified'])->name('mahasiswa.store');
Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->middleware(['auth', 'verified'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->middleware(['auth', 'verified'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->middleware(['auth', 'verified'])->name('mahasiswa.destroy');

//Route Tugas Akhir
Route::get('/data_tugas_akhir', [TugasAkhirController::class, 'tugas_akhir'])->middleware(['auth', 'verified'])->name('tugas_akhir.data');
Route::get('/tugas_akhir', [TugasAkhirController::class, 'index'])->middleware(['auth', 'verified'])->name('tugas_akhir');
Route::get('/tugas_akhir/create', [TugasAkhirController::class, 'create'])->middleware(['auth', 'verified'])->name('tugas_akhir.create');
Route::post('/tugas_akhir', [TugasAkhirController::class, 'store'])->middleware(['auth', 'verified'])->name('tugas_akhir.store');
Route::get('/tugas_akhir/{id}/edit', [TugasAkhirController::class, 'edit'])->middleware(['auth', 'verified'])->name('tugas_akhir.edit');
Route::put('/tugas_akhir/{id}', [TugasAkhirController::class, 'update'])->middleware(['auth', 'verified'])->name('tugas_akhir.update');
Route::delete('/tugas_akhir/{id}', [TugasAkhirController::class, 'destroy'])->middleware(['auth', 'verified'])->name('tugas_akhir.destroy');

require __DIR__.'/auth.php';