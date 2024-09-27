<?php

namespace App\Http\Controllers;


use App\Models\Empresa;
use App\Models\OrdemServico;
use App\Models\Cliente;
use App\Models\Servico;
/*use Dotenv\Validator;*/
use Illuminate\Support\Facades\Validator;
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
        return view('OrdemServico.index', compact('servicos', 'empresas', 'clientes','ordemservicos'));
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
        return view('OrdemServico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        OrdemServico::create($request->all());

        return redirect()->route('ordem_servicos.index')->with('success', 'Ordem de Servicos criada com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(OrdemServico $ordemservicos, $id)
    {
        OrdemServico::with('cliente', 'servico', 'Empresa')->find($id);
        return view('OrdemServico.show', compact('ordemservico'));
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

        return view('OrdemServico.editar', compact('servicos','empresas', 'clientes', 'ordemservicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator ::make($request->all(),[
            'cliente_id'=>'integer',
            'servico_id'=>'integer',
            'empresa_id'=>'integer',
            'data_inicial'=>'date',
            'data_final'=>'date',
            'valor'=>'decimal',
            'status' =>'boolean'
        ]);
        $ordemservicos = OrdemServico::find($id);

        if (!$ordemservicos){
            return redirect()->back()->with('error', 'Ordem de serviço não encontrada.');
        }

        $ordemservicos->servico_id = $request->input('servico_id');
        $ordemservicos->cliente_id = $request->input('cliente_id');
        $ordemservicos->empresa_id = $request->input('empresa_id');
        $ordemservicos->data_inicial = $request->input('data_inicial');
        $ordemservicos->data_final =$request->input('data_final');
        $ordemservicos->valor = $request->input('valor');
        $ordemservicos->status = $request->input('status');

        $ordemservicos->save();

        return redirect()->route('ordem_servicos.index')->with('success', 'Ordem de serviço atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ordemservico = OrdemServico::find($id);
        $ordemservico->delete();
        return redirect()->route('ordem_servicos.index')->with('success', 'Ordem de Servico Excluida com sucesso');
    }

    public function atualizarStatus(Request $request,$id)
    {
        $ordemservicos = OrdemServico::find($id);
        $ordemservicos->status = true;
        $ordemservicos->save();

        return redirect()->route('ordem_servicos.index');
    }
}
