<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('', [UserController::class, 'index'])
        ->middleware([
            'can:Manage Users',
        ])
        ->name('user.index');

    Route::group(['prefix' => 'create', 'middleware' => ['can:Create Users']], function () {
        Route::get('', [UserController::class, 'create'])
            ->name('user.create');

        Route::post('', [UserController::class, 'store'])
            ->name('user.store');
    });
    Route::group(['prefix' => '{user}'], function () {
        Route::get('', [UserController::class, 'show', 'middleware' => ['can:View Users']])
            ->name('user.show');

        Route::group(['prefix' => 'edit', 'middleware' => ['can:Edit Users']], function () {
            Route::get('', [UserController::class, 'edit'])
                ->name('user.edit');

            Route::post('', [UserController::class, 'update'])
                ->name('user.update');
        });

        Route::get('delete', [UserController::class, 'destroy'])
            ->middleware([
                'can:Delete Users',
            ])
            ->name('user.destroy');
    });
});
