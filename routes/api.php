<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('device')->group(function () {
    Route::post('register')->uses('DeviceController@register')->name('register-device');
    Route::post('purchase')->uses('DeviceController@purchase')->name('purchase');
    Route::post('check-subscription')->uses('DeviceController@check')->name('check-subscription');
});

Route::prefix('report')->group(function () {
    Route::get('get')->uses('ReportsController@getReport')->name('generate-report');
});
