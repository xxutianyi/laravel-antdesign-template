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

Route::middleware('auth.session')->prefix('internal')->name('api.internal.')->group(function () {
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
    Route::apiResource('visit-record', App\Http\Controllers\Api\VisitRecordController::class);
    Route::apiResource('leads', App\Http\Controllers\Api\LeadController::class);
    Route::apiResource('lead-note', App\Http\Controllers\Api\LeadNoteController::class);

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('leads/filter', [App\Http\Controllers\Api\ReportController::class, 'leadsFilter'])->name('leads.filter');
        Route::get('leads/trend', [App\Http\Controllers\Api\ReportController::class, 'leadsTrend'])->name('leads.trend');
    });

});


Route::get('leads/trend', [App\Http\Controllers\Api\ReportController::class, 'leadsTrend'])->name('leads.trend');
