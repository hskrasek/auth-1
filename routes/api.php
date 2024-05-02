<?php

use App\Http\Controllers\APIStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api')
    ->name('api.user');

Route::any('/http-statuses')
    ->uses(APIStatuses::class)
    ->middleware('auth:api')
    ->name('api.http-statuses');
