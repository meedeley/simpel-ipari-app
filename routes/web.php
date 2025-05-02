<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/template', function () {
    return view('template');
});

Route::get('/', DashboardController::class)->name('dashboard.index');
