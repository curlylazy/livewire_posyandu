<?php

use App\Http\Controllers\PdfController;
use App\Livewire\Admin\Activity\ActivityAE;
use App\Livewire\Admin\Activity\ActivityList;
use Illuminate\Support\Facades\Route;

// *** CONTROLLER PDF

// *** ADMIN
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Login;
use App\Livewire\Admin\Blog\BlogAE;
use App\Livewire\Admin\Blog\BlogList;
use App\Livewire\Admin\Galeri\GaleriAE;
use App\Livewire\Admin\Galeri\GaleriList;
use App\Livewire\Admin\Package\PackageAE;
use App\Livewire\Admin\package\PackageList;
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
Route::get('cetak/{id}', [PdfController::class, 'cetak_po'])->name('cetakpdf');

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

    Route::get('/user', UserList::class)->name('admin_user_list');
    Route::get('/user/add', UserAE::class)->name('admin_user_add');
    Route::get('/user/edit/{id}', UserAE::class)->name('admin_user_edit');

    Route::get('/activity', ActivityList::class)->name('admin_activity_list');
    Route::get('/activity/add', ActivityAE::class)->name('admin_activity_add');
    Route::get('/activity/edit/{id}', ActivityAE::class)->name('admin_activity_edit');

    Route::get('/blog', BlogList::class)->name('admin_blog_list');
    Route::get('/blog/add', BlogAE::class)->name('admin_blog_add');
    Route::get('/blog/edit/{id}', BlogAE::class)->name('admin_blog_edit');

    Route::get('/galeri', GaleriList::class)->name('admin_galeri_list');
    Route::get('/galeri/add', GaleriAE::class)->name('admin_galeri_add');
    Route::get('/galeri/edit/{id}', GaleriAE::class)->name('admin_galeri_edit');

    Route::get('/package', PackageList::class)->name('admin_package_list');
    Route::get('/package/add', PackageAE::class)->name('admin_package_add');
    Route::get('/package/edit/{id}', PackageAE::class)->name('admin_package_edit');
});
