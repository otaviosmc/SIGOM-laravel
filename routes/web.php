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

// ROTA DE BLOCOS

Route::get('/blocos/cadastrar', function () {
    if (Auth::user() && Auth::user()->is_admin == 1) {
        return Inertia::render('CadastrosBasicos/BlocosCadastrar');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('blocos.create');

Route::post('/blocos/cadastrar', [BlocoController::class, 'store'])->name('blocos.store');

Route::get('/blocos', [BlocoController::class, 'index'])->name('blocos.index');

route::delete('/blocos/{id}', [BlocoController::class, 'destroy'])->name('blocos.destroy');


// -------------------------------
    
Route::get('/areas', function () {
    if (Auth::user() && Auth::user()->is_admin == 1){
    return Inertia::render('CadastrosBasicos/Areas');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('areas');



require __DIR__.'/auth.php';
