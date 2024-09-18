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

        return response()->json([
            'status' => true,
            'empresas' =>$empresas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.create');
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
        return response()->json(['status' => true,'message' => "Empresa Criada com sucesso!", 'empresa' => $empresa], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
