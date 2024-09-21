<?php

use App\Models\Laboratorio;
use Illuminate\Support\Facades\Route;

Route::get('laboratorio-view', function () {
    $laboratorios = Laboratorio::paginate(10);
    return view('livewire.laboratorio-view', compact('laboratorios'));
})
    ->middleware(['auth', 'verified'])
    ->name('livewire.laboratorio-view');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


