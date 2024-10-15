<?php

use App\Models\Laboratorio;
use App\Models\Reactivos;
use Illuminate\Support\Facades\Route;

Route::get('laboratorio', function () {
    $laboratorios = Laboratorio::paginate(10);
    return view('dashboard.laboratorio', compact('laboratorios'));
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.laboratorio');

Route::get('reactivo', function () {
    $laboratorios = Reactivos::paginate(10);
    return view('dashboard.reactivo');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.reactivo');

Route::get('estante', function () {
    $laboratorios = Reactivos::paginate(10);
    return view('dashboard.estante');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.estante');

Route::get('pictogramas', function () {
    $laboratorios = Reactivos::paginate(10);
    return view('dashboard.pictogramas');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.pictogramas');

Route::get('proveedores', function () {
    $laboratorios = Reactivos::paginate(10);
    return view('dashboard.proveedor');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard.proveedor');


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


