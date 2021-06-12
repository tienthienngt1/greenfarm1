<?php

use Illuminate\Support\Facades\Route;
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
    return redirect()->route('login');
});
Auth::routes();

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    // home
    Route::resource('/home', '\App\Http\Controllers\HomeController')->only(['index', 'store'])->names(['index' => 'home']);

    // personal
    Route::group(['prefix' => '/ca-nhan'], function () {
        Route::resource('/', '\App\Http\Controllers\Personal\PersonalController')->only(['index', 'store']);
        Route::resource('/thong-tin', '\App\Http\Controllers\Personal\InfouserController')->only(['index', 'store']);
        Route::resource('/thong-ke-gioi-thieu', '\App\Http\Controllers\Personal\RefferalController')->only(['index', 'store']);
        Route::resource('/thong-ke-thu-nhap', '\App\Http\Controllers\Personal\ProfitController')->only(['index', 'store']);
        Route::resource('/lich-su-giao-dich', '\App\Http\Controllers\Personal\HistoryController')->only(['index', 'store']);
        Route::resource('/doi-mat-khau', '\App\Http\Controllers\Personal\ChangePasswordController')->only(['index', 'store']);
        Route::resource('/kich-hoat-tai-khoan', '\App\Http\Controllers\Personal\VerificationController')->only(['index', 'store']);
    });

    // tien trinh
    Route::get('/tien-trinh', ['App\Http\Controllers\Job\JobController', 'index']);

    // Shop
    Route::resource('/cua-hang', '\App\Http\Controllers\Shop\ShopController')->only(['index', 'store']);

    // contact
    Route::resource('/lien-he', '\App\Http\Controllers\Contact\ContactController')->only(['index', 'store']);
    
    // guide
    Route::view('huong-dan', 'guide.index');
   
    //adminitration
    Route::resource('/adminitration', '\App\Http\Controllers\Admin\AdminController')->only(['index', 'store'])->middleware('admin');
});
