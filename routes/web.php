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

Route::namespace('User')->group(function () {
    Route::post('/e-bonpinjam/loginproses', 'AuthController@loginproses');
    Route::get('/e-bonpinjam/logout', 'AuthController@logout');

    Route::post('/e-bonpinjam/lupapassword/{token}', 'AuthController@updatePassword');
    Route::post('/e-bonpinjam/lupapassword', 'AuthController@lupapasswordpost');
    Route::get('/e-bonpinjam/lupapassword/{token}', 'AuthController@getPassword');
    Route::get('/e-bonpinjam/lupapassword', 'AuthController@lupapassword');

    Route::post('/e-bonpinjam/registrasi', 'AuthController@store');
    Route::get('/e-bonpinjam/registrasi', 'AuthController@create');

    Route::post('/e-bonpinjam/lacak', 'MasyarakatController@postlacak');
    Route::get('/e-bonpinjam/lacak', 'MasyarakatController@lacak');

    Route::get('/e-bonpinjam', 'AuthController@login')->name('login');

    Route::middleware('auth:masyarakat')->group(function () {
        Route::get('/e-bonpinjam/user', 'MasyarakatController@index')->name('userebonpinjam');

        Route::post('/e-bonpinjam/user/ubahprofil/{id}', 'ProfilMasyarakatController@update');
        Route::post('/e-bonpinjam/user/ubahpassword', 'ProfilMasyarakatController@updatepassword');
        Route::get('/e-bonpinjam/user/ubahprofil/{id}', 'ProfilMasyarakatController@edit');
        Route::get('/e-bonpinjam/user/ubahpassword', 'ProfilMasyarakatController@editpassword');
        Route::get('/e-bonpinjam/user/profil', 'ProfilMasyarakatController@index');

        Route::post('/e-bonpinjam/user/tambah/ambildata', 'MasyarakatController@ambildata');
        Route::post('/e-bonpinjam/user/tambah', 'MasyarakatController@storepeminjaman');
        Route::get('/e-bonpinjam/user/tambah', 'MasyarakatController@peminjaman');
        Route::get('/e-bonpinjam/user/cetak/{peminjaman}', 'MasyarakatController@pdf');
        Route::get('/e-bonpinjam/user/detail/{peminjaman}', 'MasyarakatController@detailpeminjaman');
    });
});

Route::namespace('Admin')->group(function () {
    Route::post('/e-bonpinjam/postlogin', 'AuthController@postlogin');
    Route::get('/e-bonpinjam/loginadmin', 'AuthController@loginadmin')->name('loginadmin');
    Route::get('/e-bonpinjam/logoutadmin', 'AuthController@logout');

    Route::middleware(['auth', 'checkrole: 1,2,3'])->group(function () {
        Route::get('/e-bonpinjam/admin', 'AdminController@index')->name('adminebonpinjam');

        // Route Peminjaman
        Route::patch('/e-bonpinjam/admin/peminjaman/{peminjaman}', 'PeminjamanController@postkonfirmasi');
        Route::post('/e-bonpinjam/admin/peminjaman', 'PeminjamanController@store');
        Route::post('/e-bonpinjam/admin/peminjaman/ambildata', 'PeminjamanController@ambildata');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/hapus', 'PeminjamanController@destroy');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/persetujuanjaksa', 'PeminjamanController@persetujuanjaksa');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/persetujuanadmin', 'PeminjamanController@persetujuanadmin');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/unduhktp', 'PeminjamanController@unduhktp');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/konfirmasi', 'PeminjamanController@konfirmasi');
        Route::get('/e-bonpinjam/admin/peminjaman/{peminjaman}/laporan', 'PeminjamanController@laporan')->name('laporanpeminjaman');
        Route::get('/e-bonpinjam/admin/peminjaman/blanko', 'PeminjamanController@blanko')->name('blankopeminjaman');
        Route::get('/e-bonpinjam/admin/peminjaman/tambah', 'PeminjamanController@create')->name('tambahpeminjaman');
        Route::get('/e-bonpinjam/admin/peminjaman', 'PeminjamanController@index')->name('peminjaman');

        //Route Jaksa
        Route::patch('/e-bonpinjam/admin/jaksa/{jaksa}', 'JaksasController@update');
        Route::post('/e-bonpinjam/admin/jaksa', 'JaksasController@store');
        Route::get('/e-bonpinjam/admin/jaksa/{jaksa}/hapus', 'JaksasController@destroy');
        Route::get('/e-bonpinjam/admin/jaksa/{jaksa}/ubah', 'JaksasController@edit')->name('ubahjaksa');
        Route::get('/e-bonpinjam/admin/jaksa/tambah', 'JaksasController@create')->name('tambahjaksa');
        Route::get('/e-bonpinjam/admin/jaksa', 'JaksasController@index')->name('jaksa');

        // Route Terdakwa
        Route::patch('/e-bonpinjam/admin/terdakwa/{terdakwa}', 'TerdakwaController@update');
        Route::post('/e-bonpinjam/admin/terdakwa', 'TerdakwaController@store');
        Route::get('/e-bonpinjam/admin/terdakwa/{terdakwa}/hapus', 'TerdakwaController@destroy');
        Route::get('/e-bonpinjam/admin/terdakwa/{terdakwa}/ubah', 'TerdakwaController@edit')->name('ubahterdakwa');
        Route::get('/e-bonpinjam/admin/terdakwa/tambah', 'TerdakwaController@create')->name('tambahterdakwa');
        Route::get('/e-bonpinjam/admin/terdakwa', 'TerdakwaController@index')->name('terdakwa');

        // Route Barang Bukti
        Route::patch('/e-bonpinjam/admin/barangbukti/{barangbukti}', 'barangBuktiController@update');
        Route::post('/e-bonpinjam/admin/barangbukti', 'barangBuktiController@store');
        Route::get('/e-bonpinjam/admin/barangbukti/{barangbukti}/hapus', 'barangBuktiController@destroy');
        Route::get('/e-bonpinjam/admin/barangbukti/{barangbukti}/ubah', 'barangBuktiController@edit');
        Route::get('/e-bonpinjam/admin/barangbukti/tambah', 'barangBuktiController@create')->name('tambahbarangbukti');
        Route::get('/e-bonpinjam/admin/barangbukti', 'barangBuktiController@index')->name('barangbukti');

        // Route Profile
        Route::post('/e-bonpinjam/admin/adminprofil', 'ProfileController@update');
        Route::post('/e-bonpinjam/admin/ubahkatasandi', 'ProfileController@updatePassword');
        Route::get('/e-bonpinjam/admin/adminprofil/edit', 'ProfileController@edit');
        Route::get('/e-bonpinjam/admin/adminprofil', 'ProfileController@index');
        Route::get('/e-bonpinjam/admin/ubahkatasandi', 'ProfileController@ubahkatasandi');
    });
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'checkrole: 1,2']], function () {

    // Route Laporan
    Route::post('/e-bonpinjam/admin/laporan/ambildata', 'LaporanController@ambildatapeminjaman');
    Route::post('/e-bonpinjam/admin/laporan', 'LaporanController@laporansemuapeminjaman');
    Route::get('/e-bonpinjam/admin/laporan/{status}/{tgl_awal}/{tgl_akhir}', 'LaporanController@laporanpeminjaman')->name('cetakLaporan');
    Route::get('/e-bonpinjam/admin/laporan', 'LaporanController@peminjaman')->name('laporanpeminjaman');
});

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'checkrole: 2']], function () {

    // Route Pengguna
    Route::patch('/e-bonpinjam/admin/pengguna/{user}', 'UsersController@update');
    Route::post('/e-bonpinjam/admin/pengguna/{user}/ubahkatasandi', 'UsersController@editpassword');
    Route::post('/e-bonpinjam/admin/pengguna', 'UsersController@store');
    Route::get('/e-bonpinjam/admin/pengguna/{user}/hapus', 'UsersController@destroy');
    Route::get('/e-bonpinjam/admin/pengguna/{user}/ubahkatasandi', 'UsersController@editpasswordform');
    Route::get('/e-bonpinjam/admin/pengguna/{user}/ubah', 'UsersController@edit');
    Route::get('/e-bonpinjam/admin/pengguna/tambah', 'UsersController@create')->name('tambahpengguna');
    Route::get('/e-bonpinjam/admin/pengguna', 'UsersController@index')->name('pengguna');

    Route::get('/e-bonpinjam/admin/datamaster', 'dataMasterController@index');
    Route::patch('/e-bonpinjam/admin/datamaster/bataswaktu/{bataswaktu}', 'dataMasterController@bataswaktu');
    Route::patch('/e-bonpinjam/admin/datamaster/kategori/{kategori}', 'dataMasterController@kategori');
});
