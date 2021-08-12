<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DashboardController;


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

// Router Auth
Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/getunitlevel2', [AuthController::class, 'get_unitlevel2'])->name('get_unitlevel2');
Route::post('/getunitlevel3', [AuthController::class, 'get_unitlevel3'])->name('get_unitlevel3');

//route jadwal
Route::get('/jadwal',[JadwalController::class,'index'])->name('jadwal');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/unit',[UnitController::class,'index']);

    // Router User
    Route::get('/admin/user', [UserController::class, 'index'])->name('user');
    Route::post('/admin/user', [UserController::class, 'add'])->name('addUser');
    // Route::put('/admin/user', [UserController::class, 'edit'])->name('editUser');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::get('/admin/user/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::get('/admin/deleteuser/{id}', [UserController::class, 'delete'])->name('deleteUser');;
    Route::get('/admin/userAktif/{id}', [UserController::class, 'userAktif'])->name('userAktif');
    Route::get('/admin/userNonaktif/{id}', [UserController::class, 'userNonaktif'])->name('userNonaktif');

    // Router Unit
    Route::get('/admin/unit', [UnitController::class, 'index'])->name('unit');
    Route::post('/admin/unit/add', [UnitController::class, 'add'])->name('addUnit');
    Route::get('/admin/unit/add/unitlevel3', [UnitController::class, 'showFromAddUnitLevel3']);
    Route::post('/admin/unit/add/unitlevel3', [UnitController::class, 'addUnitLevel3'])->name('addUnitLevel3');
    Route::get('/admin/unit/add/unitlevel2', [UnitController::class, 'showFromAddUnitLevel2']);
    Route::post('/admin/unit/add/unitlevel2', [UnitController::class, 'addUnitLevel2'])->name('addUnitLevel2');
    Route::get('/admin/unit/add/kantorinduk', [UnitController::class, 'showFromAddUnitKantorInduk']);
    Route::post('/admin/unit/add/kantorinduk', [UnitController::class, 'addKantorInduk'])->name('addKantorInduk');
    Route::get('/admin/unit/add', [UnitController::class, 'showFromAddUnit']);
    Route::delete('/admin/unit', [UnitController::class, 'delete']);
    Route::put('/admin/unit/edit', [UnitController::class, 'update'])->name('editUnit');
    Route::get('/admin/unit/edit/kantorinduk/{id}', [UnitController::class, 'showFromEditKantorInduk']);
    Route::put('/admin/unit/edit/kantorinduk', [UnitController::class, 'editKantorInduk'])->name('editKantorInduk');
    Route::get('/admin/unit/edit/unitlevel2/{id}', [UnitController::class, 'showFromEditUnitLevel2']);
    Route::put('/admin/unit/edit/unitlevel2', [UnitController::class, 'editUnitLevel2'])->name('editUnitLevel2');
    Route::get('/admin/unit/edit/{id}', [UnitController::class, 'showFormEdit']);
});


