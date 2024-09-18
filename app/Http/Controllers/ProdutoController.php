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

        return response()->json([
            'status' => true,
            'produtos' => $produtos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = Produto::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Produto Criado com sucesso!",
            'produto' => $produto
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produtos = Produto::find($id);

        if (!$produtos) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json([
            'status' => true,
            'produto' =>$produtos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produtos = Produto::find($id);
        if (!$produtos) {
            return response()->json(['message' => 'Produto não encontrado '],404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'string|max:255',
            'valor' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['erros'=> $validator->erros()], 422);
        }

        $produtos->update($request->all());

        return response()->json([
            'status' => true,
            'message' => "produto atualizado com sucesso!",
            'produto' =>$produtos
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produtos = Produto::find($id);
        if (!$produtos) {
            return response()->json(['message' => 'Produto não encontrado'],404);
        }

        $produtos -> delete();
        return response()->json(['message' => 'Produto removido com sucesso']);
    }
}
