<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function welcome()
{
    // Verifica se o usuário está autenticado
    if (auth()->check()) {
        // Redireciona para a rota /index se o usuário estiver autenticado
        return redirect()->route('index');
    }

    // Caso contrário, renderiza a página de boas-vindas
    return inertia('Welcome', [
        'auth' => auth()->user(),
        'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}

}
