<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

Route::get('', [HomeController::class, 'index'])
    ->name('index');

Route::get('{user:url}', [HomeController::class, 'link'])
    ->name('card.index');

Route::get('dashboard', [HomeController::class, 'dashboard'])
    ->name('dashboard');

require __DIR__ . '/web/auth.php';
