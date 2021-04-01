<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Auth'], function() {

    Route::group(['middleware' => 'guest'], function() {

        // Login Routes
        Route::get('login', LoginShowAction::class)
             ->name('login.show');
        Route::post('login', LoginStoreAction::class)
             ->name('login.store');

        // Registration Routes
        Route::get('register', RegisterShowAction::class)
             ->name('register.show');
        Route::post('register', RegisterStoreAction::class)
             ->name('register.store');

        Route::get('activate/{activationToken}', ActivateAction::class)
            ->name('register.activate');

        // Password Reset Routes
        Route::get('password/reset', PasswordShowAction::class)
             ->name('password.request');
        Route::post('password/email', PasswordStoreAction::class)
             ->name('password.email');
        Route::get('password/reset/{token}', ResetShowAction::class)
             ->name('password.reset');
        Route::post('password/reset', ResetStoreAction::class);
    });

    // Logout Route
    Route::get('logout', LogoutAction::class)
         ->middleware('auth')
         ->name('logout');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', Dashboard\IndexAction::class)
        ->name('dashboard');

    Route::get('/account/settings', Account\SettingEditAction::class)
        ->name('settings.edit');
    Route::post('/account/settings', Account\SettingUpdateAction::class)
        ->name('settings.update');
});

Route::get('/{slug?}', PageAction::class)
    ->where('slug', '([A-Za-z0-9\-\/]+)')
    ->middleware('cache.page')
    ->name('page.show');
