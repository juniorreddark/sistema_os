<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Clientes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
<body>
    <button><a href="{{ route('pagina_inicial') }}">Página Inicial</a></button>
    <form action="{{ route('clientes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="">NOME: </label>
        <input type="text" name="nome" id="nome">
        <label for="">Data Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento">
        <label for="">Foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*">
        <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="1">Ativo</option>
                <option value="0">Inativo</option>
            </select>
        <button type="submit">Salvar</button>
    </form>
    <!--<a href="{{ route('clientes.create') }}">Cadastrar Cliente</a>-->
    @if (@session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NOME</th>
                <th scope="col">DATA DE NASCIMENTO</th>
                <th scope="col">FOTO</th>
                <th scope="col">STATUS</th>
                <th scope="col">OPÇÕES</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($clientes as $cliente )
                <th scope="row">{{ $cliente->id }}</th>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->data_nascimento}}</td>
                <td>
                    @if ($cliente->foto)
                        <img src="{{ asset('storage/' . $cliente->foto) }}" alt="Foto do cliente" width="50">
                    @else
                        Sem Foto
                    @endif
                </td>

                <td>
                    @if ($cliente->status)
                        ativo
                    @else
                        Inativo
                    @endif
                </td>

                <td>
                    <button><a href="{{ route('clientes.edit', $cliente->id) }}"><img src="https://img.icons8.com/?size=100&id=rEXGukWVdKQW&format=png&color=000000" height="35" width="35">Editar</a></button>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>


            @endforeach
        </tbody>
    </table>
