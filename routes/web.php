<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlocoController;

Route::get('/', function () {
    if (Auth::user()){
        return redirect('/index');
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/index', function () {
    return Inertia::render('Index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/situacao', function () {
    if (Auth::user() && Auth::user()->is_admin == 1){
    return Inertia::render('CadastrosBasicos/Situacao');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('situacao');

Route::get('/bloco', function () {
    if (Auth::user() && Auth::user()->is_admin == 1){
    return Inertia::render('CadastrosBasicos/Bloco');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('bloco.create');

Route::post('/bloco', [BlocoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('bloco.store');
    
Route::get('/area', function () {
    if (Auth::user() && Auth::user()->is_admin == 1){
    return Inertia::render('CadastrosBasicos/Area');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('area.create');

Route::post('/area', [BlocoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('area.store');

require __DIR__.'/auth.php';
