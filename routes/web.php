<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;


Route::get('{connect:url}', [HomeController::class, 'index'])
    ->name('index');

Route::get('go-to/{type}/{foreign_key_id}', [HomeController::class, 'goTo'])
    ->name('go-to');

Route::get('dashboard', [HomeController::class, 'index'])
    ->name('dashboard');

Route::group(['prefix' => 'cms'], function () {
    Route::get('dashboard', [HomeController::class, 'cms'])
        ->name('cms.index');
    require __DIR__ . '/web/auth.php';
    require __DIR__ . '/web/user.php';
    require __DIR__ . '/web/role.php';
    require __DIR__ . '/web/link.php';
});
