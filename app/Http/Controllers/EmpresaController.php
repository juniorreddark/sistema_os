<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('Empresa.index', compact('empresas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'razao_social'=>'required',
            'cnpj'=>'required',
            'endereco'=>'required',
            'numero'=>'required',
            'telefone' =>'required',
            'cep' =>'required',
        ]);

        $empresa = Empresa::create($request->all());
        return redirect()->route('empresas.index')->with('success', 'Empresa criada com sucesso.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('Empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $empresa = Empresa::find($id);
        return view('Empresa.editar', compact('empresa'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'razao_social'=>'required',
            'cnpj'=>'required',
            'endereco'=>'required',
            'numero'=>'required',
            'telefone' =>'required',
            'cep' =>'required',
        ]);
        $empresa = Empresa::find($id);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success', 'Empresas atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('success', 'Empresa removida com sucesso.');
    }
}
