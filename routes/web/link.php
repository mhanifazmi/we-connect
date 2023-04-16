<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'links', 'middleware' => ['auth']], function () {
    Route::get('', [LinkController::class, 'index'])
        ->middleware([
            'can:Manage Links',
        ])
        ->name('link.index');

    Route::group(['prefix' => 'create', 'middleware' => ['can:Create Links']], function () {
        Route::get('', [LinkController::class, 'create'])
            ->name('link.create');

        Route::post('', [LinkController::class, 'store'])
            ->name('link.store');
    });
    Route::group(['prefix' => '{link}'], function () {
        Route::get('', [LinkController::class, 'show', 'middleware' => ['can:View Links']])
            ->name('link.show');

        Route::group(['prefix' => 'edit', 'middleware' => ['can:Edit Links']], function () {
            Route::get('', [LinkController::class, 'edit'])
                ->name('link.edit');

            Route::post('', [LinkController::class, 'update'])
                ->name('link.update');
        });

        Route::get('delete', [LinkController::class, 'destroy'])
            ->middleware([
                'can:Delete Links',
            ])
            ->name('link.destroy');
    });
});
