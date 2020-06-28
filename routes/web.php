<?php

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

// Route::get('/', 'IndexController@index');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('users', 'UsersController');
    Route::resource('guru', 'GuruController');
    Route::resource('siswa', 'SiswaController');
    Route::get('import','SiswaController@import')->name('siswa.import');
    Route::post('mulai-import','SiswaController@mulai_import')->name('siswa.mulai-import');
    Route::resource('jpelanggaran', 'JenisPelanggaranController');
});

Route::group(['prefix' => 'ppiket', 'as' => 'ppiket.', 'middleware' => 'auth'], function () {
    Route::get('dynamic-field', 'DynamicFieldController@index')->name('dpiket.dynamic-field');
    Route::post('dynamic-field/insert', 'DynamicFieldController@insert')->name('dynamic-field.insert');
    Route::resource('dpiket', 'DaftarPiketController');
    Route::resource('izin', 'IzinController');
    Route::post('dpiket/devkelas', 'DaftarPiketController@devkelas')->name('dpiket.devkelas');
    Route::post('dpiket/devsiswa', 'DaftarPiketController@devsiswa')->name('dpiket.devsiswa');
    Route::get('dpiket/cari', 'DaftarPiketController@cari')->name('dpiket.cari');
});

Route::group(['prefix' => 'bkonseling', 'as' => 'bkonseling.', 'middleware' => 'auth'], function () {
    Route::resource('konseling', 'KonselingController');
    Route::post('konseling/devkelas', 'KonselingController@devkelas')->name('konseling.devkelas');
    Route::post('konseling/devsiswa', 'KonselingController@devsiswa')->name('konseling.devsiswa');
});

Route::group(['prefix' => 'pgerbang', 'as' => 'pgerbang.', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('izin', 'PetugasGerbangController@izin')->name('izin');
    Route::post('store', 'PetugasGerbangController@store')->name('store');
    Route::resource('pgerbang', 'PetugasGerbangController');
});


Route::group(['prefix' => 'wakasis', 'as' => 'wakasis.', 'middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('dynamic-field', 'DynamicFieldController@index')->name('dpiket.dynamic-field');
    Route::get('wakasis/siswa', 'WakasisController@siswa')->name('wakasis.siswa');
    Route::get('wakasis/rekap_siswa', 'WakasisController@rekap_siswa')->name('wakasis.rsiswa');
    Route::get('wakasis/notif_pelanggaran', 'WakasisController@lihat_semua_notif_pelanggaran')->name('wakasis.npelanggaran');
    Route::get('wakasis/show_notif_pelanggaran/{nis}', 'WakasisController@show_notif_pelanggaran')->name('wakasis.show.npelanggaran');
    Route::get('wakasis/show_rekap_siswa/{nis}', 'WakasisController@show_rekap_siswa')->name('wakasis.show.rsiswa');
    Route::get('wakasis/show_rekap_guru/{id}', 'WakasisController@show_rekap_guru')->name('wakasis.show.rguru');
    Route::get('wakasis/show_rekap_perubahan_data/{id}', 'WakasisController@show_rekap_perubahan_data')->name('wakasis.show.rperdata');
    Route::put('wakasis/update_rekap_perubahan_data/{id}', 'WakasisController@update_rekap_perubahan_data')->name('wakasis.update.rperdata');
    Route::get('wakasis/rekap_perubahan_data', 'WakasisController@rekap_perubahan_data')->name('wakasis.rperdata');
    Route::get('wakasis/rekap_guru', 'WakasisController@rekap_guru')->name('wakasis.rguru');
    Route::get('wakasis/akumulasi_pelanggaran', 'WakasisController@akumulasi_pelanggaran')->name('wakasis.apelanggaran');
    Route::get('wakasis/mulai_akumulasi_pelanggaran', 'WakasisController@mulai_akumulasi_pelanggaran')->name('wakasis.mulai_akumulasi_pelanggaran');
    Route::get('wakasis/rekap_izin', 'WakasisController@rekap_izin')->name('wakasis.rizin');
    Route::get('wakasis/cetak_rekap_siswa_detail/{id}', 'WakasisController@cetak_rekap_siswa_detail')->name('wakasis.cetak.rsiswa.detail');
    Route::get('wakasis/cetak_rekap_siswa/{id}', 'WakasisController@cetak_rekap_siswa')->name('wakasis.cetak.rsiswa');
    Route::get('wakasis/cetak_rekap_guru/{id}', 'WakasisController@cetak_rekap_guru')->name('wakasis.cetak.rguru');
    Route::get('wakasis/cetak_rekap_guru_detail/{id}', 'WakasisController@cetak_rekap_guru_detail')->name('wakasis.cetak.rguru.detail');
    Route::post('wakasis/devsiswa', 'WakasisController@devsiswa')->name('wakasis.devsiswa');
    Route::post('wakasis/devkelas', 'WakasisController@devkelas')->name('wakasis.devkelas');
    Route::resource('wakasis', 'WakasisController');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/api/datatable/konseling', 'KonselingController@dataTable')->name('api.datatable.konseling');
    Route::get('/api/datatable/izin', 'IzinController@dataTable')->name('api.datatable.izin');
    Route::get('/api/datatable/dpiket', 'DaftarPiketController@dataTable')->name('api.datatable.dpiket');
    Route::get('/api/datatable/users', 'UsersController@dataTable')->name('api.datatable.users');
    Route::get('/api/datatable/guru', 'GuruController@dataTable')->name('api.datatable.guru');
    Route::get('/api/datatable/jpelanggaran', 'JenisPelanggaranController@dataTable')->name('api.datatable.jpelanggaran');
    Route::get('/api/datatable/izin_gerbang', 'PetugasGerbangController@dataTable')->name('api.datatable.izin_gerbang');
    Route::get('/api/datatable/rekap_siswa', 'WakasisController@dataTableRekapSiswa')->name('api.datatable.rsiswa');
    Route::get('/api/datatable/rekap_guru', 'WakasisController@dataTableRekapGuru')->name('api.datatable.rguru');
    Route::get('/api/datatable/siswa', 'WakasisController@dataTableSiswa')->name('api.datatable.siswa');
    Route::get('/api/datatable/data-siswa', 'SiswaController@dataTableSiswa')->name('api.datatable.data-siswa');
    Route::get('/api/datatable/rekap_izin', 'WakasisController@dataTableRekapIzin')->name('api.datatable.rizin');
    Route::get('/api/datatable/rekap_perubahan_data', 'WakasisController@dataTablePerubahanData')->name('api.datatable.rperdata');
    Route::get('/api/datatable/notif_pelanggaran', 'WakasisController@dataTableNotifPelanggaran')->name('api.datatable.npelanggaran');
});

