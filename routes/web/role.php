<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'roles', 'middleware' => ['auth']], function () {
    Route::get('', [RoleController::class, 'index'])
        ->middleware([
            'can:Manage Roles',
        ])
        ->name('role.index');

    Route::group(['prefix' => 'create', 'middleware' => ['can:Create Roles']], function () {
        Route::get('', [RoleController::class, 'create'])
            ->name('role.create');

        Route::post('', [RoleController::class, 'store'])
            ->name('role.store');
    });
    Route::group(['prefix' => '{role}'], function () {
        Route::get('show', [RoleController::class, 'show', 'middleware' => ['can:View Roles']])
            ->name('role.show');

        Route::group(['prefix' => 'edit', 'middleware' => ['can:Edit Roles']], function () {
            Route::get('', [RoleController::class, 'edit'])
                ->name('role.edit');

            Route::post('', [RoleController::class, 'update'])
                ->name('role.update');
        });

        Route::get('delete', [RoleController::class, 'destroy'])
            ->middleware([
                'can:Delete Roles',
            ])
            ->name('role.destroy');
    });
});
