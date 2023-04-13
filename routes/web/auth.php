<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {

    Route::group(['prefix' => 'register'], function () {
        Route::get('', [RegisteredUserController::class, 'create'])
            ->name('register');

        Route::post('', [RegisteredUserController::class, 'store']);
    });

    Route::group(['prefix' => 'login'], function () {
        Route::get('', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('', [AuthenticatedSessionController::class, 'store']);
    });

    Route::group(['prefix' => 'forgot-password'], function () {
        Route::get('', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');
    });

    Route::group(['prefix' => 'reset-password'], function () {
        Route::get('{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('', [NewPasswordController::class, 'store'])
            ->name('password.update');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::group(['middleware' => ['throttle:6,1']], function () {
        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->name('verification.send');
    });

    Route::group(['prefix' => 'confirm-password'], function () {
        Route::get('', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('', [ConfirmablePasswordController::class, 'store']);
    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
