<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CategoryController;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('/collections', [App\Http\Controllers\Frontend\FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{products_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);

Route::get('/chart/category-distribution', 'ChartController@categoryDistribution');

// Route::get('wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [App\Http\Controller\Frontend\WishlistController::class, 'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class,'index']);

    Route::get('profile',[App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile',[App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);
});



Route::get('thank-you', [App\Http\Controllers\Frontend\FrontendController::class,'thankyou']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){

Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
 
//Route::get('/gamecomp',App\Http\Livewire\Admin\Gamecomp\Index::class);

Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);


Route::post('/add/{id}', [App\Http\Controllers\Admin\CartController::class, 'add']);
//Route::post('/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
//Route::get('admin/category/edit/{id}', 'CategoryController@edit')->name('category.edit');

Route::get('admin/category/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
Route::delete('admin/category/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');


Route::get('admin/product/{product}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit');
Route::delete('admin/product/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product.destroy');


Route::get('admin/sliders/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('slider.edit');
Route::delete('admin/sliders/{slider}', [App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('slider.destroy');



Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
    Route::get('/category','index')->name('category.index');
    Route::get('/category/create', 'create');
    Route::post('/category', 'store');
    //Route::get('/category/{category}/edit','edit');
    Route::put('/category/{category}', 'update');
});

Route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function () {
    Route::get('/sliders','index')->name('slider.index');
    Route::get('sliders/create', 'create'); 
    Route::post('sliders/create','store');
  //  Route::get('sliders/{slider}/edit', 'edit');
    Route::put('sliders/{slider}', 'update');
    Route::get('sliders/{slider}/delete', 'destroy');
});

Route::resource('admin/gamecomp', App\Http\Controllers\Admin\GameCompController::class);
Route::get('/gamecomp/index', [App\Http\Controllers\Admin\GameCompController::class, 'index'])->name('gamecomp.index');
Route::get('/gamecomp/create', [App\Http\Controllers\Admin\GameCompController::class, 'create'])->name('gamecomp.create');
Route::post('/gamecomp/store', [App\Http\Controllers\Admin\GameCompController::class, 'store'])->name('gamecomp.store');

Route::get('admin/gamecomp/{gamecomp}/edit', [App\Http\Controllers\Admin\GameCompController::class, 'edit'])->name('gamecomp.edit');
Route::delete('admin/gamecomp/{gamecomp}', [App\Http\Controllers\Admin\GameCompController::class, 'destroy'])->name('gamecomp.destroy');
Route::put('admin/gamecomp/{gamecomp}', [App\Http\Controllers\Admin\GameCompController::class, 'update'])->name('gamecomp.update');

Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function (){
    Route::get('/users', 'index');
    Route::get('/users/create', 'create');
    Route::post('/users', 'store');
    Route::get('/users/{user_id}/edit', 'edit');
    Route::put('users/{user_id}', 'update');
    Route::put('users/{user_id}/delete', 'destroy');
});

// Route::get('/pie-chart', function () {
//     return view('pie-chart');
// });


Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
    Route::get('/products','index');
    Route::get('/products/create','create');
    Route::post('/products','store');
    Route::get('/products/{product}/edit','edit');
    Route::put('/products/{product}','update');
    Route::get('/products/{product_id}/delete','destroy');
    Route::get('product-image/{product_image_id}/delete','destroyImage');

});

//Route::resource('admin/gamecomp', App\Http\Controllers\Admin\GameCompController::class);
    //Route::get('/gamecomp','index');
   // Route::get('/gamecomp/create','create');
   // Route::post('/gamecomp','store');
   // Route::get('/gamecomp/{gamecomp}/edit','edit');
   // Route::put('/gamecomp/{gamecomp}','update');
  //  Route::get('/gamecomp/{gamecomp_id}/delete','destroy');
});



         

