<?php

use App\Http\Controllers\MidjourneyController;
use App\Http\Controllers\RunwayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/midjourney/webhook', [MidjourneyController::class, 'webhook'])
    ->middleware(['auth:sanctum', 'throttle:60,1'])
    ->name('webhook');


Route::post('/runway/webhook', [RunwayController::class, 'webhook'])
    ->middleware('throttle:60,1')
    ->name('runway.webhook');

