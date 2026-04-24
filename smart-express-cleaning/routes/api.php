<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CleanerController;
use App\Http\Controllers\Api\CleaningJobController;
use App\Http\Controllers\Api\InventoryItemController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PropertyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('properties', PropertyController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('cleaning-jobs', CleaningJobController::class);
Route::apiResource('cleaners', CleanerController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('inventory-items', InventoryItemController::class);
