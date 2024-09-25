<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('Produtos.index', compact('produtos'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'valor'=>'required',
            'descricao'=>'required',

        ]);

        Produto::create($request->all());
        return redirect()->route('produtos.index')->with('success', 'Produto criada com sucesso.');

        /*$produto = Produto::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Produto Criado com sucesso!",
            'produto' => $produto
        ],200);*/
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
      return view('Produto.show', compact('produto'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('Produtos.editar', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'nome' => 'string|max:255',
            'valor' => 'integer',
            'descricao' => 'string|max:255',
        ]);

        $produto = Produto::find($id);
        $produto->update($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        return redirect()->route('produtos.index')->with('success','Produto removido com sucesso');

    }
}
