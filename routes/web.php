<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlocoController;
use App\Http\Controllers\SituacaoController;
use App\Http\Controllers\AreaController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/index', function () {
    return Inertia::render('Index');
})->middleware(['auth', 'verified'])->name('index');

// ROTAS DE BLOCOS

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
// ROTAS DE SITUAÇÕES
Route::get('/situacao/cadastrar', function () {
    if (Auth::user() && Auth::user()->is_admin == 1) {
        return Inertia::render('CadastrosBasicos/SituacaoCadastrar');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('situacao.create');

Route::post('/situacao/cadastrar', [SituacaoController::class, 'store'])->name('situacao.store');

Route::get('/situacao', [SituacaoController::class, 'index'])->name('situacao.index');

route::delete('/situacao/{id}', [SituacaoController::class, 'destroy'])->name('situacao.destroy');

// -------------------------------
// ROTAS DE ÁREAS

Route::get('/area/cadastrar', function () {
    if (Auth::user() && Auth::user()->is_admin == 1) {
        return Inertia::render('CadastrosBasicos/AreaCadastrar');
    }
    return redirect('/index');
})->middleware(['auth', 'verified'])->name('area.create');

Route::post('/area/cadastrar', [AreaController::class, 'store'])->name('area.store');

Route::get('/area', [AreaController::class, 'index'])->name('area.index');

route::delete('/area/{id}', [AreaController::class, 'destroy'])->name('area.destroy');

//----------------------------------------------------------------
    
// Route::get('/areas', function () {
//     if (Auth::user() && Auth::user()->is_admin == 1){
//     return Inertia::render('CadastrosBasicos/Area');
//     }
//     return redirect('/index');
// })->middleware(['auth', 'verified'])->name('areas');



require __DIR__.'/auth.php';
