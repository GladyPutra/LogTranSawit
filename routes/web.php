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

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/', 'LoginController@home')->name('home')->middleware('guest');
Route::get('/', 'DashboardController@home')->name('home');
Route::get('/login', 'LoginController@home')->name('login.home')->middleware('guest');
Route::post('/login-auth', 'LoginController@doLogin')->name('login.auth');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/register-customer', 'LoginController@register')->name('login.register');
Route::post('/daftar-customer', 'LoginController@daftar')->name('login.daftar');
Route::get('/login/lupa-password','LoginController@lupapassword')->name('login.lupapassword');
Route::post('/login/reset-password','LoginController@reset')->name('login.reset');


Route::get('beranda', 'DashboardController@index')->name('dashboard')->middleware('tologin'); // Dashboard
//Pengelolaan Kamar

//Pengelolaan Akun
Route::get('pegawai', 'AkunController@index')->name('pegawai.tampil')->middleware('tologin');
Route::post('/pegawai/tambah', 'AkunController@tambah')->name('pegawai.baru')->middleware('tologin');

Route::post('/pegawai/simpan', 'AkunController@simpan')->name('pegawai.simpan')->middleware('tologin');
Route::patch('/pegawai/doedit/{id}', 'AkunController@doedit')->name('pegawai.doedit')->middleware('tologin');
Route::get('/pegawai/cari','AkunController@pencarian')->name('pegawai.cari')->middleware('tologin');
Route::get('/pegawai/ubah/{id}','AkunController@ubah')->name('pegawai.ubah')->middleware('tologin');
Route::delete('/pegawai/hapus/{id}','AkunController@hapus')->name('pegawai.hapus')->middleware('tologin');
Route::get('/pegawai/reset-password/{id}', 'AkunController@resetpassword')->name('pegawai.resetpassword')->middleware('tologin');


//----------------------------------pengelolaan peta---------------------------//
Route::get('/afdeling/tambahpeta',function(){
	return view('afdeling.peta');
})->name('tampilpeta');
Route::post('/afdeling/simpan','AfdelingController@simpan')->name('afdeling.simpan')->middleware('tologin');

//---------------------------------pengelolaan peta 2-------------------------//
Route::get('/afdeling-apalasma/peta','AfdelingController@petaasisten')->name('tampilpeta2');

//--------------------------------warning-------------------------

Route::GET('/username-exist/{user}','WarningController@warningusername')->name("w-user");

Route::delete('/afdeling/delete','AfdelingController@delete')->name('deleteafdeling');

//-----------------------------blok---------------------------//

Route::post('/afdeling/tambahblok','AfdelingController@tambahblok')->name('tambahblok');
Route::delete('/afdeling/hapusblok','AfdelingController@hapusblok')->name('hapusblok');

Route::post('/afdeling/tambahtph','AfdelingController@tambahtph')->name('tambahtph');

//-----------------------------assisten------------------------//
Route::post('/afdeling-aplasma/tambahtaksasi','AfdelingController@tambahtaksasi')->name('tambahtaksasi');

//-----------------------krani-----------------------------------//
Route::get('krani/peta-krani',function(){
	return view('peta-krani.peta');
})->name('peta-krani');

Route::patch('krani/tambahpanen','KraniController@tambahpanen')->name('tambahpanen');

//-----------------------------manager pabrik---------------------------//
Route::get('managerpabrik/beranda','ManpabrikController@beranda')->name('managerpabrikberanda');
Route::get('managerpabrik/kelolakapasitas','ManpabrikController@kelolakapasitas')->name('kelolakapasitas');
Route::get('managerpabrik/kelolashift','ManpabrikController@kelolashift')->name('kelolashift');
Route::post('managerpabrik/tambahshift','ManpabrikController@tambahshift')->name('tambahshift');
Route::patch('managerpabrik/editshift','ManpabrikController@editshift')->name('editshift');
Route::delete('managerpabrik/deleteshift/{id}','ManpabrikController@deleteshift')->name('deleteshift');
Route::patch('managerpabrik/editkapasitas','ManpabrikController@editkapasitas')->name('editkapasitas');
Route::delete('managerpabrik/deletekapasitas/{id}','ManpabrikController@deletekapasitas')->name('deletekapasitas');
Route::get('managerpabrik/displayangkut','ManpabrikController@displayangkut')->name('displayangkut');
Route::get('managerpabrik/displayangkutajax/{id_afd}','ManpabrikController@displayangkut_ajax')->name('displayangkut_ajax');
Route::get('managerpabrik/displaydistribusi',function(){
	return view('managerpabrik.displaydistribusi');
})->name('displaydistribusi');
Route::get('managerpabrik/historidistribusi/tampil/{tanggal}','ManpabrikController@historidistribusi')->name('historidistribusi');
Route::get('managerpabrik/historidistribusi/tanggal','ManpabrikController@tanggaldistribusi')->name('tanggaldistribusi');

//--------------------------sopir------------------//
Route::get('/sopir/angkut-panen','SopirController@angkutpanenindex')->name('angkutpanenindex');
Route::post('sopir/do-angkut-panen','SopirController@angkutpanen')->name('angkutpanen');



//-----------------ajax----------------//
Route::get('afdeling/getstatusafdeling','AfdelingController@getstatus')->name('getstatusafdeling');
Route::get('afdeling/displayblokselect','AfdelingController@showblok')->name('showblok');
Route::get('refreshcoord','ManpabrikController@refreshcoord')->name('refreshcoord');
Route::get('refreshcoordhistori','ManpabrikController@refreshcoordhistori')->name('refreshcoordhistori');

Route::delete('deletetph','AfdelingController@deletetph')->name('deletetph');
Route::get('refreshtph/{id_blok}','AfdelingController@refreshtph')->name('refreshtph');
Route::get('refreshblok/{id_afd}','AfdelingController@refreshblok')->name('refreshblok');
