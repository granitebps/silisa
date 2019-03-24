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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/home', 'HomeController@index')->name('home');

    // Master
    Route::resource('provinsi', 'Master\ProvinsiController');
    Route::resource('kabupatenkota', 'Master\KabupatenKotaController');
    Route::resource('kecamatan', 'Master\KecamatanController');
    Route::resource('desa', 'Master\DesaController');
    Route::resource('wilayah', 'Master\WilayahController');
    Route::resource('area', 'Master\AreaController');
    Route::resource('rayon', 'Master\RayonController');
    Route::resource('potensi', 'Master\PotensiController');

    // Dropdown
    Route::get('dropdown_kabupaten', 'DropdownController@kabupaten');
    Route::get('dropdown_kecamatan', 'DropdownController@kecamatan');
    Route::get('dropdown_desa', 'DropdownController@desa');

    // Menu Listrik Masuk Desa
    // Uploader Data
    Route::get('/upload', 'ListrikMasukDesa\UploaderDataController@upload')->name('upload');
    Route::get('/download/{name}', 'ListrikMasukDesa\UploaderDataController@download')->name('download');
    Route::post('/import', 'ListrikMasukDesa\UploaderDataController@import')->name('import');
    Route::get('/log', 'ListrikMasukDesa\UploaderDataController@log')->name('log');
    // Info Data Desa
    Route::resource('info_data_desa', 'ListrikMasukDesa\InfoDataDesaController');
    // Road Map SILISA
    Route::resource('roadmap_silisa', 'ListrikMasukDesa\RoadMapSilisaController');
    // Desa Prioritas
    Route::resource('desa_prioritas', 'ListrikMasukDesa\DesaPrioritasController');

    // Tambah All
    Route::get('/tambah', 'HomeController@tambah')->name('tambah');
    Route::post('/tambah', 'HomeController@tambah_proses')->name('tambah_proses');

    // AutoComplete
    Route::get('/autocomplete_provinsi', 'HomeController@autocomplete_provinsi')->name('autocomplete.provinsi');
    Route::get('/autocomplete_kabupaten', 'HomeController@autocomplete_kabupaten')->name('autocomplete.kabupaten');
    Route::get('/autocomplete_kecamatan', 'HomeController@autocomplete_kecamatan')->name('autocomplete.kecamatan');
    Route::get('/autocomplete_desa', 'HomeController@autocomplete_desa')->name('autocomplete.desa');
    Route::get('/autocomplete_roadmap', 'HomeController@autocomplete_roadmap')->name('autocomplete.roadmap');
    Route::get('/autocomplete_desa_prioritas', 'HomeController@autocomplete_desa_prioritas')->name('autocomplete.desa_prioritas');

    // =============================================== MENU LAMA =========================================================

    // Table Info Desa
    Route::get('/info_desa', 'InfoDesaController@info_desa')->name('info.desa');
    Route::get('/info_desa_rt', 'InfoDesaController@info_desa_rt')->name('info.desa_rt');
    Route::get('/info_desa_pembangkit', 'InfoDesaController@info_desa_pembangkit')->name('info.desa_pembangkit');
    Route::get('/info_desa_potensi', 'InfoDesaController@info_desa_potensi')->name('info.desa_potensi');

    // Table Roadmap
    Route::get('/target', 'RoadmapController@target')->name('roadmap.target');
    Route::get('/realisasi', 'RoadmapController@realisasi')->name('roadmap.realisasi');

    // Table Desa Prioritas
    Route::get('/desa_prioritas_all', 'DesaPrioritasController@desa_prioritas')->name('desa.prioritas');
});
