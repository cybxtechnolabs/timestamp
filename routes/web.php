<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', 'DashboardController@index');

Route::get('artisan', function(Request $request) {
    return Artisan::call($request->command);
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('users', ['middleware' => 'adminAccess', 'as' => 'admin.users', 'uses' => 'UserController@index']);
    //Route::get('setting', ['middleware' => 'adminAccess', 'as' => 'admin.setting', 'uses' => 'SettingController@edit']);
    Route::get('users/approve/{user_id?}', ['middleware' => 'adminAccess', 'as' => 'admin.usersapprove', 'uses' => 'UserController@approve']);
    //Route::get('setting/update/{id?}', ['middleware' => 'adminAccess', 'as' => 'admin.settingupdate', 'uses' => 'SettingController@update']);
   // Route::post('settings/update/{id}', ['middleware' => 'adminAccess', 'as' => 'admin.settings', 'uses' => 'SettingController@index'] 'GalleryController@update')->name('gallery.update');
});

//Route::get('/setting/index', 'SettingController@index')->name('setting.index');
//Route::get('/settings/create', 'SettingController@create')->name('setting.create');
//Route::post('/settings/store', 'SettingController@store')->name('setting.store');
//Route::get('/setting/edit', 'SettingController@edit')->name('setting.edit');

Route::get('/setting', 'Admin\SettingController@edit')->name('setting');
Route::get('/setting/create', 'Admin\SettingController@create')->name('setting.create');
Route::post('/setting/update/{id}', 'Admin\SettingController@update')->name('settingupdate');

//Route::get('/settings/delete/{id}', 'SettingController@destroy')->name('setting.destroy');
//Route::get('/settings/show', 'GalleryController@show')->name('gallery.show');
//Route::post('/settings/update', 'SettingController@update')->name('setting.update');

Route::get('/import', 'ImportController@index')->name('import');
Route::post('/import', 'ImportController@uploadexcel')->name('upload');

Route::get('/report', 'ReportController@index')->name('report.index');
Route::post('/report/generate', 'ReportController@generateReport')->name('report.generate');
Route::get('/report/generatepdf/{start_date}/{end_date}', 'ReportController@generateReportpdf')->name('report.generatepdf');



//Route::get('verify/{code}', ['as' => 'email.verify', 'uses' => 'UserController@verifyEmail']);


//Route::post('settigs/video-thumbnail', ['as' => 'settings.video', 'uses' => 'SettingController@updateVideo']);