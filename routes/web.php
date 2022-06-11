<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\AllBrandsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoriesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\user\HomeController;


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

Route::prefix('admin')->group(function () {
	Route::get('/profile/{id}', [AdminProfileController::class, 'AdminProfile'])->middleware(['auth']);
	Route::get('/edit_profile/{id}', [AdminProfileController::class, 'EditAdminProfile'])->middleware(['auth']);
	Route::post('/update_profile/{id}', [AdminProfileController::class, 'UpdateAdminProfile'])->middleware(['auth']);
	Route::get('/change_password/{id}', [AdminProfileController::class, 'ChangeAdminPassword'])->middleware(['auth']);
	Route::post('/update_password', [AdminProfileController::class, 'UpdateAdminPassword'])->middleware(['auth']);
	Route::get('/all_brands', [AllBrandsController::class, 'all_brands'])->middleware(['auth'])->name('all_brands');
	Route::post('/add_brand', [AllBrandsController::class, 'add_brand'])->middleware(['auth'])->name('add_brand');
	Route::get('/edit_brand/{id}', [AllBrandsController::class, 'edit_brand'])->middleware(['auth'])->name('edit_brand');
	Route::post('/update_brand/{id}', [AllBrandsController::class, 'update_brand'])->middleware(['auth'])->name('update_brand');
	Route::get('/delete_brand/{id}', [AllBrandsController::class, 'delete_brand'])->middleware(['auth'])->name('delete_brand');

	Route::get('/all_categories', [CategoryController::class, 'all_categories'])->middleware(['auth'])->name('all_categories');
	Route::post('/add_category', [CategoryController::class, 'add_category'])->middleware(['auth'])->name('add_category');
	Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category'])->middleware(['auth'])->name('edit_category');
	Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->middleware(['auth'])->name('update_category');
	Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category'])->middleware(['auth'])->name('delete_category');

	Route::get('/sub/all_categories', [SubCategoriesController::class, 'all_categories'])->middleware(['auth'])->name('all_sub_categories');
	Route::post('/sub/add_category', [SubCategoriesController::class, 'add_category'])->middleware(['auth'])->name('add_sub_category');
	Route::get('/sub/edit_category/{id}', [SubCategoriesController::class, 'edit_category'])->middleware(['auth'])->name('edit_sub_category');
	Route::post('/sub/update_category/{id}', [SubCategoriesController::class, 'update_category'])->middleware(['auth'])->name('update_sub_category');
	Route::get('/sub/delete_category/{id}', [SubCategoriesController::class, 'delete_category'])->middleware(['auth'])->name('delete_sub_category');

	Route::get('/add_product', [ProductController::class, 'add_product'])->middleware(['auth'])->name('add_product');
	Route::post('/add_new_product', [ProductController::class, 'add_new_product'])->middleware(['auth'])->name('add_new_product');
});



// user route

Route::get('/', [HomeController::class, 'Home']);
