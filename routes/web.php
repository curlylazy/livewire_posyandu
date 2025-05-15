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
use App\Livewire\Admin\Package\PackageAE;
use App\Livewire\Admin\package\PackageList;
use App\Livewire\Admin\Pasien\PasienAE;
use App\Livewire\Admin\Pasien\PasienDetail;
use App\Livewire\Admin\Pasien\PasienList;
use App\Livewire\Admin\Pemeriksaan\PemeriksaanAE;
use App\Livewire\Admin\Pemeriksaan\PemeriksaanDetail;
use App\Livewire\Admin\Pemeriksaan\PemeriksaanList;
use App\Livewire\Admin\Pemeriksaan\PemeriksaanRiwayat;
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

    // *** Pemeriksaan
    Route::get('/pemeriksaan', PemeriksaanList::class)->name('admin_pemeriksaan_list');
    Route::get('/pemeriksaan/riwayat', PemeriksaanRiwayat::class)->name('admin_pemeriksaan_riwayat');
    Route::get('/pemeriksaan/detail/{id}', PemeriksaanDetail::class)->name('admin_pemeriksaan_detail');
    Route::get('/pemeriksaan/add', PemeriksaanAE::class)->name('admin_pemeriksaan_add');
    Route::get('/pemeriksaan/edit/{id}', PemeriksaanAE::class)->name('admin_pemeriksaan_edit');

    // *** Laporan
    Route::get('/laporan/pemeriksaan', LapPemeriksaan::class)->name('admin_laporan_pemeriksaan');
});
