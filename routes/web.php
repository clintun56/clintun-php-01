<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;

Route::get('/', function () {
    $dbConnected = false;
    try {
        DB::connection()->getPdo();
        $dbConnected = true;
    } catch (\Exception $e) {
        $dbConnected = false;
    }
    return view('welcome', ['dbConnected' => $dbConnected]);
});

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('leaves', LeaveController::class, ['parameters' => ['leaves' => 'leave']]);
Route::get('/leaves/{leave}/pdf', [LeaveController::class, 'downloadPdf'])->name('leaves.pdf');
Route::get('/leaves/{leave}/pdf-view', [LeaveController::class, 'viewPdf'])->name('leaves.pdf-view');
