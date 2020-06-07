<?php

use Illuminate\Support\Facades\Route;

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
Route::namespace('Admin')->group(function () {

    Route::prefix('adminpanel')->group(function () {
        // Login
        Route::get('/', 'DefaultController@index')->name('admin.index')->middleware('admin');
        Route::get('/login', 'DefaultController@login')->name('admin.login');
        Route::post('/login', 'DefaultController@authenticate')->name('admin.authenticate');
        Route::get('/logout', 'DefaultController@logout')->name('admin.logout');
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('adminpanel')->group(function () {
            // User
            Route::resource('user', 'UserController');
            // Profile
            Route::get('/profile', 'ProfileController@profile')->name('profile.edit');
            Route::get('/profile/password', 'ProfileController@profilepassword')->name('profilepassword.edit');
            Route::post('/profile', 'ProfileController@profileupdate')->name('profile.update');
            Route::post('/profile/password', 'ProfileController@profilepasswordupdate')->name('profilepassword.update');
            // Settings
            Route::get('/setting', 'SettingController@setting')->name('setting.edit');
            Route::post('/setting', 'SettingController@settingupdate')->name('setting.update');
            // Page
            Route::post('/page/sortable', 'PageController@sortable')->name('page.sortable');
            Route::resource('page', 'PageController');
            // Video
            Route::post('/video/sortable', 'VideoController@sortable')->name('video.sortable');
            Route::resource('video', 'VideoController');
            // New
            Route::resource('new', 'NewController');
            // Reportage
            Route::resource('reportage', 'ReportageController');
            // Bulletin
            Route::resource('bulletin', 'BulletinController');
            // Member
            Route::resource('member', 'MemberController');
            // Slider
            Route::post('/slider/sortable', 'SliderController@sortable')->name('slider.sortable');
            Route::resource('slider', 'SliderController');
            // Social Media
            Route::post('/socialmedia/sortable', 'SocialMediaController@sortable')->name('socialmedia.sortable');
            Route::resource('socialmedia', 'SocialMediaController');
            // File Upload
            Route::resource('file', 'FileController');
        });
    });
});

Route::namespace('Site')->group(function () {
    // Home Page
    Route::get('/', 'DefaultController@index')->name('home.index');
    // Pages
    Route::get('/sayfa/{slug}', 'PageController@detail')->name('page.detail');
    Route::get('/dissiad/{slug}', 'PageController@detail')->name('page.detail');
    Route::get('/fuarlar/{slug}', 'PageController@detail')->name('page.detail');
    Route::get('/yayinlar/{slug}', 'PageController@detail')->name('page.detail');
    Route::get('/bilgi-bankasi/{slug}', 'PageController@detail')->name('page.detail');
    // News
    Route::get('/haberler', 'NewController@index')->name('newlist.index');
    Route::get('/haber/{slug}', 'NewController@detail')->name('newdetail.list');
    // Bulletin
    Route::get('/bultenler', 'BulletinController@index')->name('bulletinlist.index');
    Route::get('/bulten/{slug}', 'BulletinController@detail')->name('bulletindetail.list');
    // Roportage
    Route::get('/roportajlar', 'ReportageController@index')->name('reportagelist.index');
    Route::get('/roportaj/{slug}', 'ReportageController@detail')->name('reportageindetail.list');
    // Members
    Route::get('/uyeler', 'MemberController@index')->name('memberlist.index');
    Route::get('/uye/{slug}', 'MemberController@detail')->name('memberdetail.list');
    // Contact
    Route::get('/iletisim', 'DefaultController@contact')->name('contact.index');
    // Search
    Route::get('/arama/', 'SearchController@index')->name('search.index');
});
