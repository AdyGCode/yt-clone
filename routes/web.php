<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\VideoController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('channels', ChannelController::class);
    Route::get('channels/{channel}/delete', [ChannelController::class, "delete"])->name('channels.delete');

    Route::resource('videos', VideoController::class);
    Route::get('videos/{video}/delete', [VideoController::class, "delete"])->name('videos.delete');
});
