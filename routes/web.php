<?php

use App\Http\Controllers\PdfController;
use App\Livewire\Admin\Dashboard;
// *** CONTROLLER PDF

// *** ADMIN
use App\Mail\SendTestMail;
// *** FRONT
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// *** mail
Route::get('/send-mail', function () {
    Mail::to('saputrastyawan.d@gmail.com')->send(new SendTestMail);

    return 'Mail Sent Successfully!! '.date('d F Y');
});

// *** pdf
Route::get('cetak/pemeriksaan', [PdfController::class, 'cetak_pemeriksaan'])->name('cetak_pemeriksaan');
Route::get('cetak/pemeriksaan_bayi', [PdfController::class, 'cetak_pemeriksaan_bayi'])->name('cetak_pemeriksaan_bayi');

// *** front
Route::livewire('/', 'pages-front::dashboard')->name('dashboard');
Route::livewire('/berita', 'pages-front::berita.list')->name('berita');
Route::livewire('/berita/{id}', 'pages-front::berita.detail')->name('berita_detail');
Route::livewire('/posyandu', 'pages-front::posyandu.list')->name('posyandu');
Route::livewire('/posyandu/{id}', 'pages-front::posyandu.detail')->name('posyandu_detail');

// *** admin
Route::livewire('admin/login', 'pages-admin::login')->name('admin_login');

Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::livewire('/', Dashboard::class)->name('admin_dashboard');

    // *** Pasien
    Route::livewire('/pasien', 'pages-admin::pasien.list')->name('admin_pasien_list');
    Route::livewire('/pasien/add', 'pages-admin::pasien.ae')->name('admin_pasien_add');
    Route::livewire('/pasien/edit/{id}', 'pages-admin::pasien.ae')->name('admin_pasien_edit');
    Route::livewire('/pasien/detail/{id}', 'pages-admin::pasien.detail')->name('admin_pasien_detail');

    // *** User
    Route::group(['middleware' => ['role:admin']], function () {
        Route::livewire('/user', 'pages-admin::user.list')->name('admin_user_list');
        Route::livewire('/user/add', 'pages-admin::user.ae')->name('admin_user_add');
        Route::livewire('/user/edit/{id}', 'pages-admin::user.ae')->name('admin_user_edit');
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
    Route::livewire('/pemeriksaan/bumilnifas/', 'pages-admin::pemeriksaan_bumilnifas.list')->name('admin_pemeriksaan_bumilnifas_list');
    Route::livewire('/pemeriksaan/bumilnifas/detail/{id}', 'pages-admin::pemeriksaan_bumilnifas.detail')->name('admin_pemeriksaan_bumilnifas_detail');
    Route::livewire('/pemeriksaan/bumilnifas/add', 'pages-admin::pemeriksaan_bumilnifas.ae')->name('admin_pemeriksaan_bumilnifas_add');
    Route::livewire('/pemeriksaan/bumilnifas/edit/{id}', 'pages-admin::pemeriksaan_bumilnifas.ae')->name('admin_pemeriksaan_bumilnifas_edit');

    // *** Pemeriksaan Bayi
    Route::livewire('/pemeriksaan/bayi/', 'pages-admin::pemeriksaan_bayi.list')->name('admin_pemeriksaan_bayi_list');
    Route::livewire('/pemeriksaan/bayi/add', 'pages-admin::pemeriksaan_bayi.ae')->name('admin_pemeriksaan_bayi_add');
    Route::livewire('/pemeriksaan/bayi/edit/{id}', 'pages-admin::pemeriksaan_bayi.ae')->name('admin_pemeriksaan_bayi_edit');
    Route::livewire('/pemeriksaan/bayi/detail/{id}', 'pages-admin::pemeriksaan_bayi.detail')->name('admin_pemeriksaan_bayi_detail');

    // *** Laporan & Rekap
    Route::livewire('/laporan/riwayat/bumilnifas', 'pages-admin::laporan.riwayat_bumil_nifas')->name('admin_laporan_riwayat_bumilnifas');
    Route::livewire('/laporan/riwayat/bayi', 'pages-admin::laporan.riwayat_bayi')->name('admin_laporan_riwayat_bayi');
    Route::livewire('/laporan/pemeriksaan/bayi', 'pages-admin::laporan.pemeriksaan_bayi')->name('admin_laporan_pemeriksaan_bayi');
    Route::livewire('/laporan/pemeriksaan', 'pages-admin::laporan.pemeriksaan')->name('admin_laporan_pemeriksaan');
    Route::livewire('/laporan/rekapbumilnifas', 'pages-admin::laporan.rekap_bumil_nifas')->name('admin_laporan_rekapbumilnifas');
    Route::livewire('/laporan/rekapbayi', 'pages-admin::laporan.rekap_bayi')->name('admin_laporan_rekapbayi');
    Route::livewire('/laporan/grafik_pemeriksaan', 'pages-admin::laporan.grafik_pemeriksaan')->name('admin_grafik_pemeriksaan');
    Route::livewire('/laporan/grafik_pasien', 'pages-admin::laporan.grafik_pasien')->name('admin_grafik_pasien');
});
