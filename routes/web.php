<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/* Rutas solo con cuenta iniciada */
Route::middleware('auth')->group(function () {
    /* Vista home */
    Route::get('/home', [AuthController::class, 'index'])->name('index');
    /* POST para salir de a cuenta */
    Route::post('/logout', [AuthController::class, 'destroy'])->name('exit');
});
/* Rutas sin cuenta iniciada */
Route::middleware('guest')->group(function () {
    /* Vista register */
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    /* Vista login */
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');

    Route::middleware('guest')->group(function () {
        /* Vista de dos factores con middleware de iniciar sesión */
        Route::get('/twoFactor', [AuthController::class, 'show2FA'])->middleware(['signed'])->name('2fa');
        /* Ingresar el codigo de dos pasos */
        Route::post('/twoF', [AuthController::class, 'confirmTwoFactor'])->name('twoFactor');
    });
    /* Registrar usuario */
    Route::post('/createUser', [AuthController::class, 'store'])->name('createAccount');
    /* Iniciar sesión */
    Route::post('/loginForm', [AuthController::class, 'login'])->name('loginForm');
    
});

/* Validación a rutas inexistentes */
Route::fallback(function () {
    return redirect('home');
});