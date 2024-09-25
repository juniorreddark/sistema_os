<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="">
        <meta name="viewport">
        <title>Lista de Ordem de Serviços</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <button><a href="{{ route('pagina_inicial') }}">Página Inicial</a></button>
        <h1>Ordem de Serviços</h1>
        <form action="{{ route('ordem_servicos.index') }}" method="POST">
            @csrf
            <label for="">SERVIÇO:</label>
            <select name="servico_id" id="servico_id">
                @foreach ($servicos as $servico)
                    <option value="{{ $servico->id }}">{{ $servico->tipo }}></option>
                @endforeach
            </select>

            <label for="">CLIENTE:</label>
            <select name="cliente_id" id="cliente_id">
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}></option>
                @endforeach
            </select>

            <label for="">EMPRESA</label>
            <select name="empresa_id" id="empresa_id">
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}">{{ $empresa->razao_social }}></option>
                @endforeach
            </select>

            <label for="">DATA INICIAL</label>
            <input type="date" name="data_inicial" id="data_inicial">

            <label for="">DATA FINAL</label>
            <input type="date" name="data_final" id="data_final">

            <label for="">VALOR:</label>
            <input type="numeric" name="valor" id="valor">

            <label for="">Status</label>
            <select name="status" id="status">
                <option value="1">Concluido</option>
                <option value="0">Em andamento</option>
            </select>

            <button type="submit">Salvar</button>
            <!--<a href="{{ route('produto.create') }}"Cadastrar Produto</a>-->
            @if (session('success'))
                <div>{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">SERVIÇO</th>
                        <th scope="col">CLIENTE</th>
                        <th scope="col">EMPRESA</th>
                        <th scope="col">DATA INICIAL</th>
                        <th scope="COL">DATA FINAL</th>
                        <th scope="col">VALOR:</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">OPÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordemservicos as $ordemservico)
                        <tr>
                            <th scope="row">{{ $ordemservico->id }}</th>
                            <td>{{ $ordemservico->servico ? $ordemservico->servico->tipo :'N/A' }}</td>
                            <td>{{ $ordemservico->clente ? $ordemservico->cliente->nome : 'N/A' }}</td>
                           <td>{{ $ordemservico->empresa ? $ordemservico->empresa->razao_social : 'N/A' }}</td>
                           <td>{{ $ordemservico->data_inicial }}</td>
                           <td>{{ $ordemservico->data_final }}</td>
                           <td>{{ $ordemservico->valor }}</td>

                           <td>
                                    @if ($ordemservico->status)
                                        concluido
                                    @else
                                        Em andamento
                                    @endif


                                <button>
                                        <a href="{{ route('ordem_servicos.edit', $ordemservico->id) }}">
                                            <div>
                                                <p>Editar</p>
                                            </div>
                                        </a>
                                </button>

                                <form action="{{ route('ordem_servicos.destroy', $ordemservico->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <p>Excluir</p>
                                    </button>
                                </form>

                                <form action="{{ route('ordem_servicos.atualizarStatus', $ordemservico->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit">
                                        <P>ATUALIZAR</P>
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
        </form>

    </body>
</html>
