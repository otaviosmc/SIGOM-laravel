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
        return Inertia::render('CadastrosBasicos/BlocosCadastrar');
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
        return redirect()->route('blocos.store')->with('success', 'Bloco cadastrado com sucesso!');
    }
    public function index(){
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }

        $blocos = Bloco::all();
        return Inertia::render('CadastrosBasicos/Blocos', [
            'blocos' => $blocos,
        ]);
    }

    public function destroy($id)
{

    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/index');
    }

    $bloco = Bloco::findOrFail($id);
    $bloco->delete();
    
    return redirect()->route('blocos.index')->with('success', 'Bloco excluído com sucesso!');
}
}
