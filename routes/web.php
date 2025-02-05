<?php

use App\Models\Theme;
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
    $data['theme'] = Theme::all();
    return view('welcome', $data);
});

Auth::routes();

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
