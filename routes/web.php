<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\admin\AllBrandsController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoriesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SlidersController;
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
	Route::get('/profile/{id}', [AdminProfileController::class, 'AdminProfile'])->middleware(['auth','admin']);
	Route::get('/edit_profile/{id}', [AdminProfileController::class, 'EditAdminProfile'])->middleware(['auth','admin']);
	Route::post('/update_profile/{id}', [AdminProfileController::class, 'UpdateAdminProfile'])->middleware(['auth','admin']);
	Route::get('/change_password/{id}', [AdminProfileController::class, 'ChangeAdminPassword'])->middleware(['auth','admin']);
	Route::post('/update_password', [AdminProfileController::class, 'UpdateAdminPassword'])->middleware(['auth','admin']);
	Route::get('/all_brands', [AllBrandsController::class, 'all_brands'])->middleware(['auth','admin'])->name('all_brands');
	Route::post('/add_brand', [AllBrandsController::class, 'add_brand'])->middleware(['auth','admin'])->name('add_brand');
	Route::get('/edit_brand/{id}', [AllBrandsController::class, 'edit_brand'])->middleware(['auth','admin'])->name('edit_brand');
	Route::post('/update_brand/{id}', [AllBrandsController::class, 'update_brand'])->middleware(['auth','admin'])->name('update_brand');
	Route::get('/delete_brand/{id}', [AllBrandsController::class, 'delete_brand'])->middleware(['auth','admin'])->name('delete_brand');

	Route::get('/all_categories', [CategoryController::class, 'all_categories'])->middleware(['auth','admin'])->name('all_categories');
	Route::post('/add_category', [CategoryController::class, 'add_category'])->middleware(['auth','admin'])->name('add_category');
	Route::get('/edit_category/{id}', [CategoryController::class, 'edit_category'])->middleware(['auth','admin'])->name('edit_category');
	Route::post('/update_category/{id}', [CategoryController::class, 'update_category'])->middleware(['auth','admin'])->name('update_category');
	Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category'])->middleware(['auth','admin'])->name('delete_category');

	Route::get('/sub/all_categories', [SubCategoriesController::class, 'all_categories'])->middleware(['auth','admin'])->name('all_sub_categories');
	Route::post('/sub/add_category', [SubCategoriesController::class, 'add_category'])->middleware(['auth','admin'])->name('add_sub_category');
	Route::get('/sub/edit_category/{id}', [SubCategoriesController::class, 'edit_category'])->middleware(['auth','admin'])->name('edit_sub_category');
	Route::post('/sub/update_category/{id}', [SubCategoriesController::class, 'update_category'])->middleware(['auth','admin'])->name('update_sub_category');
	Route::get('/sub/delete_category/{id}', [SubCategoriesController::class, 'delete_category'])->middleware(['auth','admin'])->name('delete_sub_category');

	Route::get('/add_product', [ProductController::class, 'add_product'])->middleware(['auth','admin'])->name('add_product');
	Route::post('/add_new_product', [ProductController::class, 'add_new_product'])->middleware(['auth','admin'])->name('add_new_product');
	Route::get('/products', [ProductController::class, 'all_products'])->middleware(['auth','admin'])->name('all_products');
	Route::get('/delete_product/{id}', [ProductController::class, 'delete_product'])->middleware(['auth','admin'])->name('delete_product');
	Route::get('/edit_product/{id}', [ProductController::class, 'edit_product'])->middleware(['auth','admin'])->name('edit_product');
	Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->middleware(['auth','admin'])->name('update_product');

	Route::get('/sliders', [SlidersController::class, 'sliders'])->middleware(['auth','admin'])->name('sliders');
	Route::post('/add_slider', [SlidersController::class, 'add_slider'])->middleware(['auth','admin'])->name('add_slider');
	Route::get('/edit_slider/{id}', [SlidersController::class, 'edit_slider'])->middleware(['auth','admin'])->name('edit_slider');
	Route::post('/update_slider/{id}', [SlidersController::class, 'update_slider'])->middleware(['auth','admin'])->name('update_slider');
	Route::get('/delete_slider/{id}', [SlidersController::class, 'delete_slider'])->middleware(['auth','admin'])->name('delete_slider');


	
});



// user route

Route::get('/', [HomeController::class, 'Home']);
