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
//     return view('login');
// });

use App\Puskesmas;
use App\Desa;


Route::view('/registerBidan', 'admin.registerBidan');


Route::get('/test', function() {
    $puskesmas = Desa::find(1);
    return $puskesmas;
  });

Route::get('/', 'HomeController@index');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get', 'HomeController@get');



// super Admin
Route::get('/superAdmin/pasien', 'SuperAdminController@showPasien')->name('superAdmin.showPasien');
Route::get('/superAdmin/pasien/getListPasien', 'SuperAdminController@getListPasien')->name('superAdmin.showListPasien');
Route::get('/superAdmin/pasien/showDetails/{id}', 'SuperAdminController@showDetails')->name('superAdmin.showDetails');
Route::get('/superAdmin/data', 'SuperAdminController@showData')->name('superAdmin.showData');
Route::get('/superAdmin/data/all', 'SuperAdminController@getAllData')->name('superAdmin.getAllData');
Route::get('/superAdmin/data/puskesmas/{id}', 'SuperAdminController@showDataPuskesmas')->name('superAdmin.showDataByPuskesmas');



// Admin
Route::get('/admin/pasien', 'AdminController@showPasien')->name('admin.showPasien');
Route::get('/admin/pasien/getListPasien', 'AdminController@getListPasien')->name('admin.showListPasien');
Route::get('/admin/pasien/showDetails/{id}', 'AdminController@showDetails')->name('admin.showDetails');
Route::get('/admin/data', 'AdminController@showData')->name('admin.showData');
Route::get('/admin/data/puskesmas', 'AdminController@showDataPuskesmas')->name('admin.showDataPuskesmas');
Route::get('/admin/data/desa/{id}', 'AdminController@showDataDesa')->name('admin.showDataDesa');

// Admin CRUD Bidan
Route::get('/admin/users', 'AdminController@showUsers')->name('admin.show');
Route::get('/admin/users/RegisterForm', 'AdminController@showRegisterForm')->name('admin.showForm');
Route::post('/admin/users/createUser', 'AdminController@register')->name('admin.create');
Route::get('/admin/users/EditForm/{id}', 'AdminController@showEditForm')->name('admin.showEditForm');
Route::put('/admin/users/{id}', 'AdminController@update')->name('admin.update');
Route::get('/admin/users/{id}', 'AdminController@show')->name('admin.showDeleteUser');
Route::delete('/admin/users/{id}', 'AdminController@destroy')->name('admin.destroyUser');


// Bidan
Route::get('/data', 'BidanController@showData')->name('users.showData');
Route::get('/data/desa', 'BidanController@showDataDesa')->name('users.showDataDesa');

// CRUD Pasien
Route::get('/pasien', 'BidanController@showPasien')->name('pasien.showPasien');
Route::get('/pasien/getListPasien', 'BidanController@getListPasien')->name('pasien.showListPasien');
Route::get('/pasien/setPasienSession/{id}', 'BidanController@setPasienSession')->name('pasien.setPasienSession');
Route::get('/pasien/DeletePasienForm/{id}', 'BidanController@showDeletePasienForm')->name('pasien.deletePasienForm');
Route::delete('/pasien/DeletePasien/{id}', 'BidanController@deletePasien')->name('pasien.deletePasien');
Route::get('/pasien/PasienForm', 'BidanController@showPasienForm')->name('pasien.showForm');
Route::post('/pasien/add', 'BidanController@createPasien')->name('pasien.createPasien');

// CRU Kohort
Route::get('/pasien/KohortForm', 'BidanController@showKohortForm')->name('pasien.showKohort');
Route::post('/pasien/addKohort', 'BidanController@createKohort')->name('pasien.createKohort');

//CRUD Kunjungan
Route::get('/pasien/KunjunganForm', 'BidanController@showKunjunganForm')->name('pasien.showKunjungan');
Route::get('/pasien/AddKunjunganForm', 'BidanController@showAddKunjunganForm')->name('pasien.showAddKunjungan');
Route::post('/pasien/addKunjungan', 'BidanController@createKunjungan')->name('pasien.createKunjungan');
Route::get('/pasien/EditKunjunganForm/{id}', 'BidanController@showEditKunjunganForm')->name('pasien.editKunjunganForm');
Route::put('/pasien/EditKunjungan/{id}', 'BidanController@updateKunjungan')->name('pasien.updateKunjungan');
Route::get('/pasien/DeleteKunjunganForm/{id}', 'BidanController@showDeleteKunjunganForm')->name('pasien.deleteKunjunganForm');
Route::delete('/pasien/DeleteKunjungan/{id}', 'BidanController@deleteKunjungan')->name('pasien.deleteKunjungan');


Route::get('/setAuto', 'BidanController@setAutoKategori');