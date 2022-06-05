<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\User\HomeController;


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
//     return view('frontend.home');
// });

// Route::get('/dashboard', function () {
//     if (Auth::user()->admin == 1) {
//         return view('admin.dashboard');
//     }
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// admin route
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth'])->name('admin.logout');
Route::get('dashboard', [AdminProfileController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('admin/profile/{id}', [AdminProfileController::class, 'AdminProfile'])->middleware(['auth']);
Route::get('admin/edit_profile/{id}', [AdminProfileController::class, 'EditAdminProfile'])->middleware(['auth']);
Route::post('admin/update_profile/{id}', [AdminProfileController::class, 'UpdateAdminProfile'])->middleware(['auth']);
Route::get('admin/change_password/{id}', [AdminProfileController::class, 'ChangeAdminPassword'])->middleware(['auth']);
Route::post('admin/update_password', [AdminProfileController::class, 'UpdateAdminPassword'])->middleware(['auth']);


// user route

Route::get('/', [HomeController::class, 'Home']);
