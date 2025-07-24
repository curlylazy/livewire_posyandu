<?php

use App\Http\Controllers\PdfController;
use App\Livewire\Admin\Activity\ActivityAE;
use App\Livewire\Admin\Activity\ActivityList;
use App\Livewire\Admin\Bayi\BayiAE;
use App\Livewire\Admin\Bayi\BayiList;
use Illuminate\Support\Facades\Route;

// *** CONTROLLER PDF

// *** ADMIN
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Blog\BlogAE;
use App\Livewire\Admin\Blog\BlogList;
use App\Livewire\Admin\Galeri\GaleriAE;
use App\Livewire\Admin\Galeri\GaleriList;
use App\Livewire\Admin\Laporan\LapPemeriksaan;
use App\Livewire\Admin\Laporan\PemeriksaanRiwayatBayi;
use App\Livewire\Admin\Laporan\PemeriksaanRiwayatBumilNifas;
use App\Livewire\Admin\Laporan\RekapBayi;
use App\Livewire\Admin\Laporan\RekapBumilNifas;
use App\Livewire\Admin\Pasien\PasienAE;
use App\Livewire\Admin\Pasien\PasienDetail;
use App\Livewire\Admin\Pasien\PasienList;
use App\Livewire\Admin\PemeriksaanBayi\PemeriksaanBayiAE;
use App\Livewire\Admin\PemeriksaanBayi\PemeriksaanBayiList;
use App\Livewire\Admin\PemeriksaanBayi\PemeriksaanBayiDetail;
use App\Livewire\Admin\PemeriksaanBumilNifas\PemeriksaanBumilNifasList;
use App\Livewire\Admin\PemeriksaanBumilNifas\PemeriksaanBumilNifasAE;
use App\Livewire\Admin\PemeriksaanBumilNifas\PemeriksaanBumilNifasDetail;
use App\Livewire\Admin\User\UserAE;
use App\Livewire\Admin\User\UserList;

// *** FRONT
use App\Livewire\Front\Dashboard as FrontDashboard;
use App\Livewire\Front\Package;
use App\Livewire\Front\Activities\ActivitiesList;
use App\Livewire\Front\Activities\ActivitiesDetail;
use App\Livewire\Front\Galeri;
use App\Livewire\Front\Kontak;
use App\Livewire\Front\Video;
use App\Mail\SendTestMail;
use Illuminate\Support\Facades\Mail;

// *** mail
Route::get('/send-mail',function() {
    Mail::to('saputrastyawan.d@gmail.com')->send(new SendTestMail());
    return "Mail Sent Successfully!! ".date('d F Y');
});

// *** pdf
Route::get('cetak/pemeriksaan', [PdfController::class, 'cetak_pemeriksaan'])->name('cetak_pemeriksaan');

// *** front
Route::get('/', FrontDashboard::class)->name('dashboard');
Route::get('/galery', Galeri::class)->name('galery');
Route::get('/packages', Package::class)->name('packages');
Route::get('/activities', ActivitiesList::class)->name('activities');
Route::get('/activities/{id}', ActivitiesDetail::class)->name('activities_detail');
Route::get('/contact', Kontak::class)->name('contact');
Route::get('/video', Video::class)->name('video');

// *** admin
Route::get('admin/login', Login::class)->name('admin_login');

Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::get('/', Dashboard::class)->name('admin_dashboard');

    // *** User
    Route::get('/user', UserList::class)->name('admin_user_list');
    Route::get('/user/add', UserAE::class)->name('admin_user_add');
    Route::get('/user/edit/{id}', UserAE::class)->name('admin_user_edit');

    // *** Pasien
    Route::get('/pasien', PasienList::class)->name('admin_pasien_list');
    Route::get('/pasien/add', PasienAE::class)->name('admin_pasien_add');
    Route::get('/pasien/edit/{id}', PasienAE::class)->name('admin_pasien_edit');
    Route::get('/pasien/detail/{id}', PasienDetail::class)->name('admin_pasien_detail');

    // *** Bayi
    Route::get('/bayi', BayiList::class)->name('admin_bayi_list');
    Route::get('/bayi/add', BayiAE::class)->name('admin_bayi_add');
    Route::get('/bayi/edit/{id}', BayiAE::class)->name('admin_bayi_edit');

    // *** Pemeriksaan Bumil Nifas
    Route::get('/pemeriksaan/bumilnifas/', PemeriksaanBumilNifasList::class)->name('admin_pemeriksaan_bumilnifas_list');
    Route::get('/pemeriksaan/bumilnifas/detail/{id}', PemeriksaanBumilNifasDetail::class)->name('admin_pemeriksaan_bumilnifas_detail');
    Route::get('/pemeriksaan/bumilnifas/add', PemeriksaanBumilNifasAE::class)->name('admin_pemeriksaan_bumilnifas_add');
    Route::get('/pemeriksaan/bumilnifas/edit/{id}', PemeriksaanBumilNifasAE::class)->name('admin_pemeriksaan_bumilnifas_edit');

    // *** Pemeriksaan Bayi
    Route::get('/pemeriksaan/bayi/', PemeriksaanBayiList::class)->name('admin_pemeriksaan_bayi_list');
    Route::get('/pemeriksaan/bayi/add', PemeriksaanBayiAE::class)->name('admin_pemeriksaan_bayi_add');
    Route::get('/pemeriksaan/bayi/edit/{id}', PemeriksaanBayiAE::class)->name('admin_pemeriksaan_bayi_edit');
    Route::get('/pemeriksaan/bayi/detail/{id}', PemeriksaanBayiDetail::class)->name('admin_pemeriksaan_bayi_detail');

    // *** Laporan & Rekap
    Route::get('/laporan/riwayat/bumilnifas', PemeriksaanRiwayatBumilNifas::class)->name('admin_laporan_riwayat_bumilnifas');
    Route::get('/laporan/riwayat/bayi', PemeriksaanRiwayatBayi::class)->name('admin_laporan_riwayat_bayi');
    Route::get('/laporan/pemeriksaan', LapPemeriksaan::class)->name('admin_laporan_pemeriksaan');
    Route::get('/laporan/rekapbumilnifas', RekapBumilNifas::class)->name('admin_laporan_rekapbumilnifas');
    Route::get('/laporan/rekapbayi', RekapBayi::class)->name('admin_laporan_rekapbayi');
});
