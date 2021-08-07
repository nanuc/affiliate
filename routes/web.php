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

Route::group(['middleware' => ['web', 'auth:sanctum']], function () {
    Route::get(config('affiliate.gui.route'), [\Nanuc\Affiliate\Http\Controllers\GuiController::class, 'show'])->name('affiliate');
    Route::post(config('affiliate.gui.route') . '/email', [\Nanuc\Affiliate\Http\Controllers\GuiController::class, 'storeEmail'])->name('affiliate.email');
});