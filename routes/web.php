<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\Cabangcontroller;
use App\Http\Controllers\IzincutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinabsenController;
use App\Http\Controllers\IzinsakitController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KonfigurasiController;

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
Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class, 'proseslogin']);
});

// routing admin
Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin',[AuthController::class, 'prosesloginadmin']);
});



Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    // 
    Route::get('/presensi/create', [PresensiController::class,'create']);
    Route::post('/presensi/store', [PresensiController::class,'store']);

    // edit Profile
    Route::get('/editprofile', [PresensiController::class,'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class,'updateprofile']);
    Route::get('/presensi/histori', [PresensiController::class,'histori']);
    Route::post('/gethistori', [PresensiController::class,'gethistori']);

    // untuk data ijin 
    Route::get('/presensi/izin', [PresensiController::class,'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class,'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class,'storeizin']);
    Route::post('/presensi/cekpengajuanizin',[PresensiController::class, 'cekpengajuanizin']);

    Route::get('/izinabsen', [IzinabsenController::class, 'create']);
    Route::post('/izinabsen/store', [IzinabsenController::class, 'store']);
    Route::get('/izinabsen/{id}/edit', [IzinabsenController::class, 'edit']);

    Route::get('/izinsakit', [IzinsakitController::class, 'create']);
    Route::post('/izinsakit/store', [IzinsakitController::class, 'store']);
    Route::get('/izinsakit/{id}/edit', [IzinsakitController::class, 'create']);

    Route::get('/izincuti', [IzincutiController::class, 'create']);
    Route::post('/izincuti/store', [IzincutiController::class, 'store']);
    Route::get('/izincuti/{id}/edit', [IzincutiController::class, 'create']);

    Route::get('/izin/{kode_izin}/showact', [PresensiController::class, 'showact']);

   
    
});


Route::middleware(['auth:user'])->group(function () {
   
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    //Route::get('/karyawan/excel-export', [KaryawanController::class, 'exportExcel']);


    // 
    Route::get('/karyawan/editprofile/{nik}', [KaryawanController::class,'editprofile']);
    Route::post('/karyawan/updateprofile/{nik}', [KaryawanController::class,'updateprofile']);
    Route::post('/karyawan/edit', [KaryawanController::class,'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class,'update']);

    // export import data
    Route::post('/karyawan/user-import', [KaryawanController::class,'import']);
    Route::get('/karyawan/user-export', [KaryawanController::class,'export']);
    


    Route::get('/panel/dashboardadminhrd', [DashboardController::class, 'dashboardadminhrd']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class,'delete']);

    Route::get('/departemen', [DepartemenController::class, 'index']);
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/{id}/update', [DepartemenController::class,'update']);
    Route::post('/departemen/{id}/delete', [DepartemenController::class,'delete']);
    

    Route::get('/presensi/monitoring',[PresensiController::class, 'monitoring']);
    Route::post('/getpresensi',[PresensiController::class, 'getpresensi']);
    Route::get('/presensi/laporan',[PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap',[PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap',[PresensiController::class, 'cetakrekap']);
    Route::get('/presensi/izinsakit',[PresensiController::class, 'izinsakit']);
    Route::post('/presensi/caritanggal',[PresensiController::class, 'caritanggal']);
    

    

    Route::post('/presensi/approveizinsakit',[PresensiController::class, 'approveizinsakit']);
    Route::get('/presensi/{id}/batalkanizinsakit',[PresensiController::class, 'batalkanizinsakit']);

    

    
   

 

    Route::get('/konfigurasi/locasikantor',[KonfigurasiController::class, 'locasikantor']);
    Route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class, 'updatelokasikantor']); 
    Route::get('/konfigurasi/jamkerja',[KonfigurasiController::class, 'jamkerja']);
    Route::post('/konfigurasi/store',[KonfigurasiController::class, 'store']);
    Route::post('/konfigurasi/edit',[KonfigurasiController::class, 'edit']);
    Route::post('/konfigurasi/update',[KonfigurasiController::class, 'update']);
    // Route::post('/konfigurasi/{nik}/setjamkerja',[KonfigurasiController::class, 'setjamkerja']);
    Route::match(['get', 'post'], '/konfigurasi/{nik}/setjamkerja', [KonfigurasiController::class, 'setjamkerja']);
    
    Route::post('/konfigurasi/{nik}/delete',[KonfigurasiController::class, 'delete']);
    Route::post('/konfigurasi/storejamkerja',[KonfigurasiController::class, 'storejamkerja']);
    Route::post(' /konfigurasi/updatesetjamkerja',[KonfigurasiController::class, 'updatesetjamkerja']);
   
    


    // Route::post('/presensi/cetaklaporan',[PresensiController::class, 'cetaklaporan']);
    Route::post('/presensi/cetaklaporankehadiran',[PresensiController::class, 'cetaklaporankehadiran']);


    Route::get('/cabang',[CabangController::class, 'index']);
    Route::post('/cabang/store',[CabangController::class, 'store']);
    Route::post('/cabang/edit',[CabangController::class, 'edit']);
    Route::post('/cabang/update',[CabangController::class, 'update']);
    Route::post('/cabang/{id}/delete',[CabangController::class, 'delete']);

    
    Route::get('/cuti', [CutiController::class, 'index']);
    Route::post('/cuti/store',[CutiController::class, 'store']);
    Route::post('/cuti/edit',[CutiController::class, 'edit']);
    Route::post('/cuti/update',[CutiController::class, 'update']);
    Route::post('/cuti/{id}/delete',[CutiController::class, 'delete']);
    
    

    
});

