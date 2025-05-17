<?php

use App\Http\Controllers\GetTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'statusCode' => 200,
        'message'    => 'API is running'
    ]);
})->name('api.home');


Route::get('/report-types', [\App\Http\Controllers\ReportTypeController::class, 'findAllReportTypes']);
Route::get('/report-statuses', [\App\Http\Controllers\ReportStatusController::class, 'findAllReportStatuses']);
Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'findAllReports']);
Route::get('/reports/{slug}', [\App\Http\Controllers\ReportController::class, 'findReportBySlug']);

Route::post('/reports', [\App\Http\Controllers\ReportController::class, 'storeReport']);

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'findAllPosts']);
Route::get('/posts/{slug}', [\App\Http\Controllers\PostController::class, 'findPostBySlug']);

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'findAllCategories']);
Route::get('/categories/{slug}', [\App\Http\Controllers\CategoryController::class, 'findCategoryWithPosts']);

Route::get('/get-token', [GetTokenController::class, 'getToken']);
