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

Route::get('/yajra','HomeController@tampil');
Route::get('yajra/data/barang','PenjualanController@yajra_barang');
Route::get('penjualan2','penjualanController@index');
//Route::group(['middleware'=>'auth'], function(){
Route::view('penjualan/barang','penjualan.penjualan');
Route::get('keluar','BarangController@keluar');
Route::post('insert','BarangController@store');
Route::post('pembelian','BarangController@pembelian');
Route::get('/home', 'HomeController@index');
Route::get('admin', 'BarangController@index');
Route::get('data/barang','BarangController@barang');
Route::resource('barang','BarangController');
//Route::group(['middleware'=>'auth'], function(){
Route::get('penjualan', 'PenjualanController@penjualan');
Route::get('pembelian','PembelianController@index');
Route::resource('penjualann','PenjualanController');
Route::get('data/penjualan','PenjualanController@penjualan');
Route::get('edit/penjualan','penjualanController@edit');
Route::get('show/penjualan','penjualanController@show');
Route::post('update/penjualan','penjualanController@update');

//
Route::post('beli/{code}','PembelianController@masuk');
Route::get('hapus/beli','PembelianController@hapus');
Route::post('bayar/pembelian/{code}/{total}','PembelianController@bayar');
Auth::routes();
Route::group(['middleware'=>'auth'], function(){
Route::get('/','BarangController@index');
Route::get('pembelian','PembelianController@index');
Route::get('transaksi/penjualan','penjualanController@index');
Route::get('barangbeli','PembelianController@data');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('cari','CetakBrgController@cetak_barang');
Route::get('hapus/transaksi/{id}/{code}','PembelianController@hapus');
Route::get('cari/barang','CetakBrgController@cari');
//cetak
Route::get('/dynamic_pdf', 'PdfController@index');
Route::get('/dynamic_pdf/pdf', 'PdfController@pdf');
Route::get('/cetaklap/barang','BarangController@cetaklapp');

Route::get('cetak/barang/pdf', 'CetakBrgController@cetak_barang');

Route::get('cetak/penjualan/pdf', 'CetakPenjualanController@cetak');
Route::get('cetak/bulan_penjualan/pdf', 'CetakPenjualanController@cetak_bulan');
Route::get('cetak/mingguan_penjualan/pdf', 'CetakPenjualanController@cetak_mingguan');
Route::get('cetak/harian_penjualan/pdf', 'CetakPenjualanController@cetak_harian');
Route::post('cetak/laporan/antara_bulan', 'CetakPenjualanController@cetak_acak');
Route::get('cetak/data/penjualan', 'CetakPenjualanController@index');

Route::get('barang/pembelian/pdf','CetakPembelianController@cetak');
Route::get('cetak/bulan_pembelian/pdf', 'CetakPembelianController@cetak_bulan');
Route::get('cetak/harian_pembelian/pdf', 'CetakPembelianController@cetak_harian');
Route::get('cetak/mingguan_pembelian/pdf','CetakPembelianController@cetak_mingguan');
Route::post('cetak/antara_bulan','CetakPembelianController@cetak_acak');
Route::get('data/pembelian','CetakPembelianController@index');




Route::get('/yajra','HomeController@tampil');
Route::get('yajra/stock','PembelianController@stock');
Route::get('stockbarang', 'PembelianController@index');
Route::get('/stock','PembelianController@stock');
Route::get('/get/{id_brg}','HomeController@get');
Route::post('/submit/{code}','HomeController@submit');
Route::post('/bayar/{code}/{total}','HomeController@bayar');
Route::get('/cetak','PdfController@cetak');
Route::get('hapus_temp/{id}/{code}','Homecontroller@hapus');
});