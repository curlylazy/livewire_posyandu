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
use App\Livewire\Admin\Laporan\GrafikPasien;
use App\Livewire\Admin\Laporan\GrafikPemeriksaan;
use App\Livewire\Admin\Laporan\LapPemeriksaan;
use App\Livewire\Admin\Laporan\LapPemeriksaanBayi;
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
use App\Livewire\Admin\Posyandu\PosyanduAE;
use App\Livewire\Admin\Posyandu\PosyanduList;
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
Route::get('cetak/pemeriksaan_bayi', [PdfController::class, 'cetak_pemeriksaan_bayi'])->name('cetak_pemeriksaan_bayi');

// *** front
Route::get('/', FrontDashboard::class)->name('dashboard');
Route::get('/galery', Galeri::class)->name('galery');
Route::get('/packages', Package::class)->name('packages');
Route::get('/activities', ActivitiesList::class)->name('activities');
Route::get('/activities/{id}', ActivitiesDetail::class)->name('activities_detail');
Route::get('/contact', Kontak::class)->name('contact');
Route::get('/video', Video::class)->name('video');

// *** admin
Route::livewire('admin/login', 'pages-admin::login')->name('admin_login');

Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::get('/', Dashboard::class)->name('admin_dashboard');

    // *** Pasien
    Route::livewire('/pasien', 'pages-admin::pasien.list')->name('admin_pasien_list');
    Route::livewire('/pasien/add', 'pages-admin::pasien.ae')->name('admin_pasien_add');
    Route::livewire('/pasien/edit/{id}', 'pages-admin::pasien.ae')->name('admin_pasien_edit');
    Route::livewire('/pasien/detail/{id}', 'pages-admin::pasien.detail')->name('admin_pasien_detail');

    // *** User
    Route::group(['middleware' => ['role:admin']], function () {
        Route::livewire('/user', 'pages-admin::user.list')->name('admin_user_list');
        Route::livewire('/user/add', 'pages-admin::user.list')->name('admin_user_add');
        Route::livewire('/user/edit/{id}', 'pages-admin::user.list')->name('admin_user_edit');
    });

    // *** Posyandu
    Route::group(['middleware' => ['role:admin']], function () {
        Route::livewire('/posyandu', 'pages-admin::posyandu.list')->name('admin_posyandu_list');
        Route::livewire('/posyandu/add', 'pages-admin::user.ae')->name('admin_posyandu_add');
        Route::livewire('/posyandu/edit/{id}', 'pages-admin::user.ae')->name('admin_posyandu_edit');
    });

    // *** Blog
    Route::livewire('/blog', 'pages-admin::blog.list')->name('admin_blog_list');
    Route::livewire('/blog/add', 'pages-admin::blog.ae')->name('admin_blog_add');
    Route::livewire('/blog/edit/{id}', 'pages-admin::blog.ae')->name('admin_blog_edit');

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
    Route::get('/laporan/pemeriksaan/bayi', LapPemeriksaanBayi::class)->name('admin_laporan_pemeriksaan_bayi');
    Route::get('/laporan/pemeriksaan', LapPemeriksaan::class)->name('admin_laporan_pemeriksaan');
    Route::get('/laporan/rekapbumilnifas', RekapBumilNifas::class)->name('admin_laporan_rekapbumilnifas');
    Route::get('/laporan/rekapbayi', RekapBayi::class)->name('admin_laporan_rekapbayi');
    Route::get('/laporan/grafik_pemeriksaan', GrafikPemeriksaan::class)->name('admin_grafik_pemeriksaan');
    Route::get('/laporan/grafik_pasien', GrafikPasien::class)->name('admin_grafik_pasien');
});
