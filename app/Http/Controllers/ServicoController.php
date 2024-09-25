<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Servico;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::with('empresa','categoria')->get();
        $empresas = Empresa::all();
        $categorias = Categoria::all();
        return view('Servico.index', compact('servicos', 'empresas','categorias'));


        /*$servicos = Servico::all();
        return view('Servico.index', compact('servicos'));
        /*$servicos = Servico::all();*/

        /*return response()->json([
            'status' => true,
            'servicos' => $servicos
        ]);*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Servico.create');
        Servico::create([
            'categoria_id' => $categoria->id,
            'empresa_id' =>$empresa->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Servico::create($request->all());
        return redirect()->route('servicos.index')->with('success','Serviço criado com sucesso');
        /*$servico = Servico::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Serviço Criado com sucesso!",
            'servico' => $servico
        ], 200);*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico, $id)
    {
        Servico::with('empresa', 'categoria')->find($id);
        return view('Servico.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico, $id)
    {
        $servico = Servico::find($id);
        $empresas  = Empresa::all();
        $categorias = Categoria::all();

        return view('Servico.editar', compact('servico', 'empresas', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator ::make($request->all(),[
            'tipo'=>'string|max:255',
            'valor'=>'numeric',
            'empresa_id'=>'integer',
            'categoria_id'=>'integer',
            'status'=>'boolean',
        ]);

        $servico = Servico::find($id);
        $servico->update($request->all());

        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $servico = Servico::find($id);
        $servico->delete();
        return redirect()->route('servicos.index')->with('success', 'Servico removido com suucesso');
    }

    public function atualizarStatus (Request $request, $id)
    {
        $servico = Servico::find($id);
        $servico->status = true;
        $servico->save();

        return redirect()->route('servicos.index');
    }
}
