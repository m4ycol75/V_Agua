<?php

use App\Http\Controllers\Admin\CanalesAguaController;
use App\Http\Controllers\Admin\UsuariosController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::prefix('admin')->group(function () {
    route::resource('canal-agua',CanalesAguaController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.canales-agua');
    route::resource('usuarios',UsuariosController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.usuarios');
});

require __DIR__.'/auth.php';
