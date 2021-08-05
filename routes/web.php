<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Staff\BpObservationsController;
use App\Http\Controllers\Staff\PatientsController;

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

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
    Route::resource('/users', UsersController::class)->middleware(['auth']);
});

Route::prefix('staff')->name('staff.')->group(function() {
    Route::resource('/users', PatientsController::class)->middleware(['auth']);
    Route::resource('/bpo', BpObservationsController::class)->middleware(['auth']);
});
