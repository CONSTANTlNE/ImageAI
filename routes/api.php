<?php

use App\Http\Controllers\BogController;
use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\RunwayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/runway/webhook', [RunwayController::class, 'webhook'])
    ->middleware('throttle:60,1')
    ->name('runway.webhook');

Route::post('/bog/webhook', [BogController::class, 'webhook'])
    ->middleware('throttle:60,1')
    ->name('bog.webhook');