<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordemservicos = OrdemServico::with('Cliente','Servico','Empresa',)->get();
        $servicos = Servico::all();
        $empresas = Empresa::all();
        $clientes = Cliente::all();
        return view('ordem_servicos.index', compact('servicos', 'empresas', 'clientes','ordemservicos'));
        /*$ordemservicos = OrdemServico::all();

        return response()->json([
            'status' => true,
            'ordemservicos' => $ordemservicos
        ]);*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordem_servicos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ordemservicos = OrdemServico::create($request->all());

        return redirect()->route('ordem_servicos.index')->with('success', 'Ordem de Servicos criada com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(OrdemServico $ordemServico)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ordemservicos = OrdemServico::find($id);
        if (!$ordemservicos){
            return redirect()->route('ordem_servicos.index')->with('error', 'ordem de serviço não encontrada');

        }

        $empresas = Empresa::all();
        $clientes = Cliente::all();
        $servicos = Servico::all();

        return view('ordem_servicos.editar', compact('servicos','empresas', 'clientes', 'ordemservicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrdemServico $ordemServico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ordemservicos = OrdemServico::find($id);
        $ordemservicos->delete();
        return redirect()->route('ordem_servicos.index')->with('success', 'Ordem de Servico com sucesso');
    }
}
