<?php

use App\Http\Controllers\FrontendAuthController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('home', [FrontendAuthController::class, 'home']);

// Route::get('login', [FrontendAuthController::class, 'loginGet'])->name('login');
// Route::post('login', [FrontendAuthController::class, 'loginPost']);
// Route::post('logout', [FrontendAuthController::class, 'logout'])->name('logout');
// Route::get('register', [FrontendAuthController::class, 'registerGet'])->name('register');
// Route::post('register', [FrontendAuthController::class, 'registerPost']);

require __DIR__.'/auth.php';
