<?php

use App\Http\Controllers\LuckyGameController;
use App\Http\Controllers\UserLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidUserLinkToken;

Route::get('/', [UserLinkController::class, 'registerForm'])->name('home');


Route::prefix('user-links')->name('userLink.')->group(function () {
    Route::post('/', [UserLinkController::class, 'register'])->name('register');

    Route::prefix('/{token}')->middleware(ValidUserLinkToken::class)->group(function () {
        Route::get('/', [UserLinkController::class, 'show'])->name('show');
        Route::post('/generate', [UserLinkController::class, 'generateNewLink'])->name('generateNew');
        Route::post('/deactivate', [UserLinkController::class, 'deactivate'])->name('deactivate');

        Route::post('/lucky', [LuckyGameController::class, 'imFeelingLucky'])->name('lucky.play');
        Route::get('/history', [LuckyGameController::class, 'history'])->name('lucky.history');
    });
});
