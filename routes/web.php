<?php


use App\Models\Bidang;
use App\Models\MahasiswaPkl;
use App\Models\RegistrasiPkl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\SemproController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\NilaiTaController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\NilaipklController;
use App\Http\Controllers\SidangTaController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\TempatPklController;
use App\Http\Controllers\UsulanPklController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LaporanPklController;
use App\Http\Controllers\NilaiSemproController;
use App\Http\Controllers\MahasiswaPklController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegistrasiPklController;
use App\Http\Controllers\PenilaianSidangController;
use App\Http\Controllers\MahasiswaPklLogBookController;
use App\Http\Controllers\Admin\Controller\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//LOGIN
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



// Rute Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth') // Menambahkan middleware 'auth' ke route dashboard
    ->name('dashboard');


//DASHBOARD

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//USER
Route::resource('users', UserController::class);

//PRODI

Route::resource('/prodi', ProdiController::class);

// Route::resource('/jurusan', JurusanController::class);

// Route::get('/jurusan', function () {
//     return view('jurusan');
// });

// Route::resource('jurusan', JurusanController::class);


// JURUSAN

// Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
// Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
// Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
// Route::get('/jurusan/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
// Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
// Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');


//RUANGAN

Route::resource('/ruangan', RuanganController::class);


//MAHASISWA

Route::resource('/mahasiswa', MahasiswaController::class);

//SESI

Route::resource('/sesi', SesiController::class);

//DOSEN

Route::resource('/dosen', DosenController::class);

//JURUSAN

Route::resource('/jurusan', JurusanController::class);

//JABATAN

Route::resource('/jabatan', JabatanController::class);

//TEMPAT PKL

Route::resource('/tempat_pkl', TempatPklController::class);

//SIDANG

Route::resource('/sidang', SidangController::class);

//USULAN_PKL
Route::put('/usulan_pkl/{id}/acc', [UsulanPklController::class, 'acc'])->name('usulan_pkl.acc');
Route::resource('/usulan_pkl', UsulanPklController::class);

//LAPORAN PKL

Route::get('/laporan-pkl/{id}/download', [LaporanPklController::class, 'download'])->name('laporan_pkl.download');
Route::resource('/laporan_pkl', LaporanPklController::class);

//LOG BOOK

Route::post('/mahasiswapkllogbook/{id}/acc', [MahasiswaPklLogBookController::class, 'acc'])->name('mahasiswapkllogbook.acc');
Route::resource('/mahasiswapkllogbook', MahasiswaPklLogBookController::class);

//JENJANG

Route::resource('/jenjang', JenjangController::class);

//GOLONGAN

    Route::resource('/golongan', GolonganController::class);

//PANGKAT

Route::resource('/pangkat', PangkatController::class);

//MAHASISWA PKL

Route::resource('/mahasiswapkl', MahasiswaPklController::class);

//JADWAL SIDANG

// Route untuk menampilkan form Tambah Jadwal Sidang PKL
Route::get('mahasiswapkl/{id}/jadwal', [MahasiswaPklController::class, 'jadwal'])->name('mahasiswapkl.jadwal');
Route::post('mahasiswapkl/storejadwal', [MahasiswaPklController::class, 'storeJadwal'])->name('mahasiswapkl.storejadwal');

//PEMBIMBING
Route::get('/mahasiswa-pkl/{id}/pembimbing', [MahasiswaPklController::class, 'tentukanPembimbing'])->name('mahasiswapkl.pembimbing');
Route::post('mahasiswapkl/storepembimbing', [MahasiswaPklController::class, 'storePembimbing'])->name('mahasiswapkl.storepembimbing');

//PENILAIAN
Route::get('/mahasiswa-pkl/{id}/penilaian', [MahasiswaPklController::class, 'penilaian'])->name('mahasiswapkl.penilaian');
Route::post('/mahasiswa-pkl/{id}/simpanPenilaian', [MahasiswaPklController::class, 'simpanPenilaian'])->name('mahasiswapkl.simpanPenilaian');

//Registrasi PKL
Route::post('/registrasi-pkl/acc/{id}', [RegistrasiPklController::class, 'acc'])->name('registrasi_pkl.acc');


Route::resource('/registrasipkl', RegistrasiPklController::class);
// Route for storing pembimbing data

Route::get('/registrasi-pkl/{id}/pembimbing', [RegistrasiPklController::class, 'Pembimbing'])->name('registrasipkl.pembimbing');
Route::post('/registrasi-pkl/storepembimbing', [RegistrasiPklController::class, 'storePembimbing'])->name('registrasipkl.storepembimbing');

//Bidang
Route::resource('/bidang', BidangController::class);
//Penilaian Sidang
Route::resource('/penilaian_sidang', PenilaianSidangController::class);

//Nilai Pembimbing PKL
Route::resource('/nilaipkl', NilaipklController::class);

//Pengajuan

//bimbingans
Route::resource('/bimbingans', BimbinganController::class);

//route penentuan pembimbing

//pengajuan

Route::resource('/pengajuan', PengajuanController::class);
Route::get('/pengajuan/{id}/pembimbing', [PengajuanController::class, 'showTentukanPembimbingForm'])->name('pengajuan.pembimbing');
Route::get('/pengajuan/{id}/tentukan-pembimbing', [PengajuanController::class, 'showTentukanPembimbingForm'])->name('pengajuan.showTentukanPembimbing');
Route::post('/pengajuan/{id}/tentukan-pembimbing', [PengajuanController::class, 'tentukanPembimbing'])->name('pengajuan.tentukanPembimbing');
Route::post('/pengajuan/{id}/accPembimbing1', [PengajuanController::class, 'accPembimbing1'])->name('pengajuan.accPembimbing1');
Route::post('/pengajuan/{id}/accPembimbing2', [PengajuanController::class, 'accPembimbing2'])->name('pengajuan.accPembimbing2');
Route::post('/pengajuan/{id}/accProdi', [PengajuanController::class, 'accProdi'])->name('pengajuan.accProdi');
Route::get('/bidang/{id_bidang}/dosen', [PengajuanController::class, 'getDosen'])->name('bidang.dosen');
Route::get('/pengajuans/getdosen/{id_bidang}', [PengajuanController::class, 'getDosen'])->name('pengajuans.getDosen');
//Sempro
Route::resource('/sempro', SemproController::class);
Route::get('sempro/{id}/jadwal', [SemproController::class, 'jadwal'])->name('sempro.jadwal');
Route::post('sempro/{id}/jadwal', [SemproController::class, 'tentukanjadwal'])->name('sempro.jadwal');
Route::get('/sempro/get-judul/{id_mhs}', [SemproController::class, 'getJudul'])->name('sempro.getJudul');



//sidang

Route::get('sidang_ta', function () {
    return view('sidang_ta');
});
Route::resource('sidang_ta', SidangTaController::class);

Route::get('sidang_ta/{id}/jadwal', [SidangTaController::class, 'jadwal'])->name('sidang_ta.jadwal');
Route::post('sidang_ta/{id}/jadwal', [SidangTaController::class, 'tentukanjadwal'])->name('sidang_ta.jadwal');
Route::get('/sidang_ta/get-judul/{id_mhs}', [SidangTaController::class, 'getJudul'])->name('sempro.getJudul');

//nilai sempro

Route::get('nilai_sempro', function () {
    return view('nilai_sempro');
});
Route::resource('nilai_sempro', NilaiSemproController::class);

//nilai ta

Route::get('nilai_ta', function () {
    return view('nilai_ta');
});
Route::resource('nilai_ta', NilaiTaController::class);
