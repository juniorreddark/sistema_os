<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return view('Cliente.index',compact('clientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Validator = Validator ::make($request->all(),[
            'nome' =>'required|string|max:255',
            'data_nascimento' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'=> 'required|boolean',

        ]);

        if ($Validator->fails()) {
            return redirect()->route('clientes.index')->with('errors', $Validator->errors());
        }
        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->data_nascimento = $request->input('data_nascimento');
        $cliente->status = $request->input('status');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('clientes', 'public');
            $cliente->foto = $path;
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente->status == 0) {
            return 'Usuário ativo';
        }else{
            return 'Usuário inativo';
        }

        return view('Cliente.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('Cliente.editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Validator ::make($request->all(),[
            'nome' =>'required|string|max:255',
            'data_nascimento' => 'required|date',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'=> 'required|boolean',

        ]);

        $cliente = Cliente::find($id);
        $foto_caminho = $request->file('foto')->store('fotos', 'public');


        $cliente->nome = $request->nome;
        $cliente->data_nascimento = $request->data_nascimento;
        $cliente->foto = $foto_caminho;
        $cliente->status = $request->status;
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso.');
    }
}
