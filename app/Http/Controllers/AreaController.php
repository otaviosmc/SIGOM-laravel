<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Bloco;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class AreaController extends Controller
{
    public function create(Request $request)
    {
        // Se os blocos foram passados como parâmetro, você pode decodificá-los
        $blocos = Bloco::all();
        return Inertia::render('CadastrosBasicos/Area', [
            'blocos' => $blocos,
        ]);
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
            'bloco_id' => 'required',
        ]);

        Area::create([
            'nome' => $request->nome,
            'bloco_id' => $request->bloco_id
        ]);

        // Redireciona após a criação
        return redirect()->route('area.store')->with('success', 'Área cadastrada com sucesso!');
    }
    public function index(){
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/index');
        }

        $area = Area::all();
        $blocos = Bloco::all();
        return Inertia::render('CadastrosBasicos/Area', [
            'area' => $area,
            'blocos'=> $blocos,
        ]);
    }

    public function destroy($id)
{

    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/index');
    }

    $area = Area::findOrFail($id);
    $area->delete();
    
    return redirect()->route('area.index')->with('success', 'Área excluída com sucesso!');
}
}
