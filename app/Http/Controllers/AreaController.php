<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function create()
    {
        // Pegamos todos os blocos para exibir no select do formulário
        $blocos = Bloco::all();

        if ($blocos->isEmpty()) {
            return inertia('Areas', ['blocos' => []]); // Envia um array vazio se não encontrar blocos
        }
        
        return inertia('Area'->with('blocos', $blocos));
    }

    public function store(Request $request)
    {
        // Verifica se o usuário é administrador
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'bloco_id' => 'required|exists:blocos,id', // Verifica se o bloco_id existe na tabela de bloco
        ]);

        // Cria a nova área
        Area::create([
            'nome' => $request->nome,
            'bloco_id' => $request->bloco_id,
        ]);

        return redirect()->route('area.index')->with('success', 'Área cadastrada com sucesso!');
    }
}
