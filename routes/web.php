<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HimaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KabinetController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\JenisKontenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.login.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.login.register');
})->name('register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/logout', [App\Http\Controllers\UserController::class, 'destroy']);


//pengunjung->
Route::get('/pengunjung', [App\Http\Controllers\DashboardController::class, 'pengunjung']);
Route::get('/akreditasiPengunjung', [App\Http\Controllers\KontenController::class, 'akreditasiPengunjung']);
Route::get('/fasilitasPengunjung', [App\Http\Controllers\KontenController::class, 'fasilitasPengunjung']);
Route::get('/kurikulumPengunjung', [App\Http\Controllers\KurikulumController::class, 'kurikulumPengunjung']);
Route::get('/faqPengunjung', [App\Http\Controllers\FaqController::class, 'faqPengunjung']);
Route::get('/profilPengunjung', [App\Http\Controllers\KontenController::class, 'profilPengunjung']);
Route::get('/prestasiDosen', [App\Http\Controllers\KontenController::class, 'prestasiDosen']);
Route::get('/prestasiMhs', [App\Http\Controllers\KontenController::class, 'prestasiMhs']);
Route::get('/beritaDosen', [App\Http\Controllers\KontenController::class, 'beritaDosen']);
Route::get('/beritaMhs', [App\Http\Controllers\KontenController::class, 'beritaMhs']);
Route::get('/kegiatanDosen', [App\Http\Controllers\KontenController::class, 'kegiatanDosen']);
Route::get('/kegiatanMhs', [App\Http\Controllers\KontenController::class, 'kegiatanMhs']);
Route::get('/fotoPengunjung', [App\Http\Controllers\KontenController::class, 'fotoPengunjung']);
Route::get('/videoPengunjung', [App\Http\Controllers\KontenController::class, 'videoPengunjung']);
Route::get('/dosenPengunjung', [App\Http\Controllers\DosenController::class, 'dosenPengunjung']);

Route::get('/dosen/{id}', [DosenController::class, 'show']);

Route::get('/alumniPengunjung', [App\Http\Controllers\AlumniController::class, 'alumniPengunjung']);
Route::get('/pesanPengunjung', [App\Http\Controllers\PesanController::class, 'pesanPengunjung']);
Route::get('/himaPengunjung', [App\Http\Controllers\HimaController::class, 'himaPengunjung']);

Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::get('/detail-berita/{id}', [App\Http\Controllers\KontenController::class, 'beritaDetail'])->name('detail-berita');
Route::get('/detail-prestasi/{id}', [App\Http\Controllers\KontenController::class, 'prestasiDetail'])->name('detail-prestasi');
Route::get('/detail-kegiatan/{id}', [App\Http\Controllers\KontenController::class, 'kegiatanDetail'])->name('detail-kegiatan');




//admin->
Route::middleware(['auth'])->group(function () {


    //  agenda
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');
    Route::put('/agenda/{id}', [AgendaController::class, 'update'])->name('agenda.update');

    //  dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //  dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
    Route::get('/arsipdosen', [DosenController::class, 'arsip'])->name('dosen.arsip');
    Route::get('/dosen/search', [DosenController::class, 'search'])->name('dosen.search');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');

    //  kurikulum
    Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
    Route::post('/kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
    Route::get('/kurikulum/{id}', [KurikulumController::class, 'show'])->name('kurikulum.show');
    Route::get('/kurikulum/search', [KurikulumController::class, 'search'])->name('kurikulum.search');
    Route::put('/kurikulum/{id}', [KurikulumController::class, 'update'])->name('kurikulum.update');


    //  kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
    Route::get('/kontak/{id}', [KontakController::class, 'show'])->name('kontak.show');
    Route::get('/kontak/search', [KontakController::class, 'search'])->name('kontak.search');
    Route::put('/kontak/{id}', [KontakController::class, 'update'])->name('kontak.update');

    //  pesan
    Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('/pesan/{id}', [PesanController::class, 'show'])->name('pesan.show');
    Route::get('/pesan/search', [PesanController::class, 'search'])->name('pesan.search');
    Route::get('/count-new-messages', [PesanController::class, 'countNewMessages'])->name('pesan.countNewMessages');
    Route::put('/pesan/{id}', [PesanController::class, 'update'])->name('pesan.update');


    //  faq
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{id}', [FaqController::class, 'show'])->name('faq.show');
    Route::get('/faq/search', [FaqController::class, 'search'])->name('faq.search');
    Route::put('/faq/{id}', [FaqController::class, 'update'])->name('faq.update');

    //  kabinet
    Route::get('/kabinet', [KabinetController::class, 'index'])->name('kabinet.index');
    Route::post('/kabinet', [KabinetController::class, 'store'])->name('kabinet.store');
    Route::get('/kabinet/{id}', [KabinetController::class, 'show'])->name('kabinet.show');
    Route::get('/kabinet/search', [KabinetController::class, 'search'])->name('kabinet.search');
    Route::put('/kabinet/{id}', [KabinetController::class, 'update'])->name('kabinet.update');

    //  hima
    Route::get('/hima', [HimaController::class, 'index'])->name('hima.index');
    Route::post('/hima', [HimaController::class, 'store'])->name('hima.store');
    Route::get('/hima/{id}', [HimaController::class, 'show'])->name('hima.show');
    Route::get('/hima/search', [HimaController::class, 'search'])->name('hima.search');
    Route::put('/hima/{id}', [HimaController::class, 'update'])->name('hima.update');

    //  jenis_konten
    Route::get('/jenis_konten', [JenisKontenController::class, 'index'])->name('jenis_konten.index');
    Route::post('/jenis_konten', [JenisKontenController::class, 'store'])->name('jenis_konten.store');
    Route::get('/jenis_konten/{id}', [JenisKontenController::class, 'show'])->name('jenis_konten.show');
    Route::get('/jenis_konten/search', [JenisKontenController::class, 'search'])->name('jenis_konten.search');
    Route::put('/jenis_konten/{id}', [JenisKontenController::class, 'update'])->name('jenis_konten.update');


    //  prestasi
    Route::get('/prestasi', [KontenController::class, 'index'])->name('prestasi.index');
    Route::get('/prestasi/search', [KontenController::class, 'search'])->name('prestasi.search');

    //  berita
    Route::get('/berita', [KontenController::class, 'berita'])->name('berita.index');
    Route::get('/berita/search', [KontenController::class, 'search'])->name('berita.search');

    //  prestasi
    Route::get('/prestasi', [KontenController::class, 'prestasi'])->name('prestasi.prestasi');
    Route::get('/prestasi/search', [KontenController::class, 'prestasi'])->name('prestasi.search');

    //  kegiatan
    Route::get('/kegiatan', [KontenController::class, 'kegiatan'])->name('kegiatan.index');
    Route::get('/kegiatan/search', [KontenController::class, 'search'])->name('kegiatan.search');

    //  akreditasi
    Route::get('/akreditasi', [KontenController::class, 'akreditasi'])->name('akreditasi.index');
    Route::get('/akreditasi/search', [KontenController::class, 'search'])->name('akreditasi.search');

    //  fasilitas
    Route::get('/fasilitas', [KontenController::class, 'fasilitas'])->name('fasilitas.index');
    Route::get('/fasilitas/search', [KontenController::class, 'search'])->name('fasilitas.search');

    //  profil
    Route::get('/profil', [KontenController::class, 'profil'])->name('profil.index');
    Route::get('/profil/search', [KontenController::class, 'search'])->name('profil.search');

    //  photo
    Route::get('/photo', [KontenController::class, 'photo'])->name('photo.index');
    Route::get('/photo/search', [KontenController::class, 'search'])->name('photo.search');

    //  video
    Route::get('/video', [KontenController::class, 'video'])->name('video.index');
    Route::get('/video/search', [KontenController::class, 'search'])->name('video.search');

    //  alumni
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');
    Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
    Route::get('/alumni/search', [AlumniController::class, 'index'])->name('alumni.search');
    Route::put('/alumni/{id}', [AlumniController::class, 'update'])->name('alumni.update');

    //  arsip konten
    Route::get('/arsipkonten', [KontenController::class, 'arsip'])->name('arsipkonten.index');
    Route::get('/arsipkonten/search', [KontenController::class, 'search'])->name('arsipkonten.search');

    Route::post('/konten', [KontenController::class, 'store'])->name('konten.store');
    Route::get('/konten/{id}', [KontenController::class, 'show'])->name('konten.show');
    Route::put('/konten/{id}', [KontenController::class, 'update'])->name('konten.update');



});



