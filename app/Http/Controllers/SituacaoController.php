<?php
namespace App\Http\Controllers;

use App\Models\Situacao;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


class SituacaoController extends Controller
{
    public function create()
    {
        return Inertia::render('CadastrosBasicos/SituacaoCadastrar');
    }

    public function store(Request $request)
    {
        // Verifica se o usuário é administrador
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }

        // Valida e cria a situacao
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Situacao::create([
            'nome' => $request->nome,
        ]);

        // Redireciona após a criação
        return redirect()->route('situacao.store')->with('success', 'Situação cadastrada com sucesso!');
    }
    public function index(){
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }

        $situacao = Situacao::all();
        return Inertia::render('CadastrosBasicos/Situacao', [
            'situacao' => $situacao,
        ]);
    }

    public function destroy($id)
{

    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/index');
    }

    $situacao = Situacao::findOrFail($id);
    $situacao->delete();
    
    return redirect()->route('situacao.index')->with('success', 'Situação excluída com sucesso!');
}
}
