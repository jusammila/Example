<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Welcome;
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
Route::get('index', [Welcome::class, 'index'])->name('index');
Route::post('login', [Welcome::class, 'login'])->name('login');
Route::post('customerlogin', [Welcome::class, 'customerlogin'])->name('customerlogin');
Route::post('reg', [Welcome::class, 'reg'])->name('reg');

Route::middleware('auth')->group(function ()
{
    Route::get('dashboard', [Welcome::class,'dashboard']);
    Route::get('admin_logout', [Welcome::class,'admin_logout']);
    
//INSTITUTE DASHBOARD CONTROLLER
});
Route::middleware('customer')->group(function ()
{
    
    Route::get('customer_dashboard', [Welcome::class,'customer_dashboard'])->name('customer_dashboard');
    Route::post('add_post', [Welcome::class,'add_post'])->name('add_post');
    Route::get('customer_logout', [Welcome::class,'customer_logout']);
});