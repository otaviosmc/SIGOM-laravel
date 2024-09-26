<?php
namespace App\Http\Controllers;

use App\Models\Bloco;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class BlocoController extends Controller
{
    public function create()
    {
        return Inertia::render('CadastrosBasicos/Blocos');
    }

    public function store(Request $request)
    {
        // Verifica se o usuário é administrador
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }

        // Valida e cria o bloco
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Bloco::create([
            'nome' => $request->nome,
        ]);

        // Redireciona após a criação
        return redirect()->route('blocos.create')->with('success', 'Bloco cadastrado com sucesso!');
    }
}
