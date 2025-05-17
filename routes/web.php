<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/report-types', App\Livewire\ReportType\Index::class);
    Route::get('/report-status', App\Livewire\ReportStatus\Index::class);
    Route::get('/categories', App\Livewire\Categories\Index::class);

    Route::get('/posts', App\Livewire\Post\Index::class)->name('posts.index');
    Route::get('/posts/create', App\Livewire\Post\Create::class)->name('posts.create');
    Route::get('/posts/edit/{slug}', App\Livewire\Post\Edit::class)->name('posts.edit');
    Route::get('/posts/show/{slug}', App\Livewire\Post\Detail::class)->name('posts.show');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
