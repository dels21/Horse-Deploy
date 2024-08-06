<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardPasienController;
use App\Http\Controllers\DicomController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ListPemeriksaanKaryawanController;
use App\Http\Controllers\ModalitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemeriksaanSayaController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\PendaftaranPemeriksaanController;
use App\Http\Controllers\DetailPemeriksaanController;
use App\Http\Controllers\MasterJenisPemeriksaanController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::middleware(['auth', 'pasien'])->group(function () {
    Route::prefix('/pasien')->group(function () {
        Route::get('/dashboard', [DashboardPasienController::class, 'showDashboard'])->name('pasien.dashboard-pasien');

        Route::get('/daftar-pemeriksaan', [PendaftaranPemeriksaanController::class, 'index'])->name('pasien.pendaftaran-pemeriksaan');
        Route::post('/store-pemeriksaan', [PendaftaranPemeriksaanController::class, 'store'])->name('pasien.store-pemeriksaan');

        Route::get('/lengkapi-data-diri', [DashboardPasienController::class, 'lengkapiDataDiri'])->name('pasien.lengkapi-data-diri');
        Route::post('/lengkapi-data-diri-submit', [PasienController::class, 'store'])->name('pasien.lengkapi-data-diri-submit');

        Route::get('/pemeriksaan', [PemeriksaanSayaController::class, 'showData'])->name('pemeriksaan_saya');
        // Route::get('/detail-pemeriksaan/{id}', [PemeriksaanSayaController::class,'showDetail'])->name('detail_pemeriksaan_pasien');
        Route::get('/detail-pemeriksaan/{nomorPemeriksaan}', [PemeriksaanSayaController::class, 'showDetail'])->name('detail_pemeriksaan_pasien');
    });
});

Route::middleware(['auth', 'dokter'])->group(function () {
    Route::prefix('/dokter')->group(function () {
        Route::get('/dashboard', [DokterController::class, 'buildDashboard']);

        Route::get('/list-pasien', function () {
            return view('dokter.list-pemeriksaan-dokter');
        });

        Route::get('list-pasien', [PemeriksaanDokterController::class, 'showData'])->name('pemeriksaan_dokter');
        Route::get('/detail-pemeriksaan/{nomorPemeriksaan}', [PemeriksaanDokterController::class, 'showDetail'])->name('detail_pemeriksaan_dokter');
        Route::get('/edit-detail/{idDetailPemeriksaan}', [PemeriksaanDokterController::class, 'editDetail'])->name('edit_detail_pemeriksaan');
        Route::post('/update-diagnosis', [PemeriksaanDokterController::class, 'updateDiagnosis'])->name('update.diagnosis');

        Route::get('/form-detail', function () {
            return view('dokter.form_detail');
        });
    });
});

Route::middleware(['auth', 'karyawan'])->group(function () {
    Route::prefix('/karyawan')->group(function () {
        Route::get('/dashboard', [KaryawanController::class, 'buildDashboard']);

        Route::get('/list-dokter', [DokterController::class, 'dokterFromUser'])->name('show_list_dokter');
        Route::post('/update-dokter', [DokterController::class, 'update'])->name('update_dokter');
        Route::post('/store-dokter', [DokterController::class, 'store'])->name('store_dokter');
        Route::delete('/delete-dokter', [DokterController::class, 'destroy'])->name('destroy_dokter');

        Route::get('/list-pasien', [PasienController::class, 'pasienFromUser'])->name('show_list_pasien');
        Route::post('/store-pasien', [KaryawanController::class, 'store_pasien'])->name('store_pasien');
        Route::post('/delete-pasien', [KaryawanController::class, 'destroy_pasien'])->name('destroy_pasien');
        Route::post('/edit-pasien', [PasienController::class, 'update_pasien'])->name('edit_pasien');

        Route::get('/list-modalitas', [ModalitasController::class, 'show'])->name('show_modalitas');
        Route::post('/store-modalitas', [ModalitasController::class, 'store'])->name('store_modalitas');
        Route::post('/update-modalitas', [ModalitasController::class, 'edit'])->name('update_modalitas');
        Route::delete('/delete-modalitas/{id}', [ModalitasController::class, 'destroy'])->name('delete_modalitas');

        Route::get('/list-dicom', [DicomController::class, 'show'])->name('show_dicom');
        Route::post('/store-dicom', [DicomController::class, 'store'])->name('store_dicom');
        Route::post('/edit-dicom', [DicomController::class, 'edit'])->name('update_dicom');
        Route::delete('/delete-dicom/{id}', [DicomController::class, 'destroy'])->name('delete_dicom');

        Route::get('/list-jenis-pemeriksaan', [MasterJenisPemeriksaanController::class, 'show'])->name('show_jenis_pemeriksaan');
        Route::post('/store-jenis-pemeriksaan', [MasterJenisPemeriksaanController::class, 'store'])->name('store_jenis_pemeriksaan');
        Route::post('/edit_jenis_pemeriksaan', [MasterJenisPemeriksaanController::class, 'edit'])->name('update_jenis_pemeriksaan');
        Route::delete('/delete_jenis_pemeriksaan/{id}', [MasterJenisPemeriksaanController::class, 'destroy'])->name('delete_jenis_pemeriksaan');

        // Route::get('/list-pemeriksaan', function () {
        //     return view('karyawan.list-pemeriksaan-karyawan');
        // });
        Route::get('/list-DICOM', function () {
            return view('karyawan.list-DICOM');
        });
        Route::get('/verifikasi', [KaryawanController::class, 'verifikasi'])->name('verifikasi');

        Route::prefix('/detailverifikasi')->group(function () {
            Route::get('/{id}', [KaryawanController::class, 'detailverifikasi'])->name('detail_verifikasi');

            Route::post('/accept', [KaryawanController::class, 'acceptVerif'])->name('accept_verif');

            Route::post('/reject', [KaryawanController::class, 'rejectVerif'])->name('reject_verif');
        });

        Route::get('/list-pemeriksaan', [ListPemeriksaanKaryawanController::class, 'index']);
        Route::get('/detail-pemeriksaan/{nomorPemeriksaan}', [ListPemeriksaanKaryawanController::class, 'showDetail'])->name('detail_pemeriksaan_karyawan');

        Route::post('/update-status', [ListPemeriksaanKaryawanController::class, 'updateStatus'])->name('update_status');
        Route::post('/update-diagnosis-keterangan', [ListPemeriksaanKaryawanController::class, 'updateDiagnosisKeterangan'])->name('update_diagnosis_keterangan');

    });
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'buildDashboard']);

        Route::get('/list-karyawan', [KaryawanController::class, 'showListKaryawan'])->name('show-list-karyawan');

        Route::post('/tambah-karyawan', [KaryawanController::class, 'storeKaryawan'])->name('tambah-karyawan');

        Route::post('/delete-karyawan', [KaryawanController::class, 'destroy_karyawan'])->name('destroy_karyawan');

        Route::post('/update-karyawan', [KaryawanController::class, 'update_karyawan'])->name('update_karyawan');

        Route::get('/list-dokter', [DokterController::class, 'dokterFromUser'])->name('show_list_dokter_admin');
        Route::post('/update-dokter', [DokterController::class, 'update'])->name('update_dokter_admin');
        Route::post('/store-dokter', [DokterController::class, 'store'])->name('store_dokter_admin');
        Route::delete('/delete-dokter', [DokterController::class, 'destroy'])->name('destroy_dokter_admin');

        Route::get('/list-pasien', [PasienController::class, 'pasienFromUser'])->name('show_list_pasien_admin');
        Route::post('/store-pasien', [KaryawanController::class, 'store_pasien'])->name('store_pasien_admin');
        Route::post('/delete-pasien', [KaryawanController::class, 'destroy_pasien'])->name('destroy_pasien_admin');
        Route::post('/edit-pasien', [PasienController::class, 'update_pasien'])->name('edit_pasien_admin');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'karyawan'])->group(function () {
    Route::prefix('karyawan')->group(function () {});
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
require __DIR__ . '/auth.php';
Route::get('/', function () {
    return redirect('/login');
});
Route::middleware('guest')->group(function () {});

?>
