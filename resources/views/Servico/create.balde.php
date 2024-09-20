<!DOCTYPE html>
    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Cadastro de Servico</title>
        </head>
        <body>
            <h1>Novo Servviço</h1>

            <form action="{{ route('servicos.store') }}" method="POST">
                @csrf
                <label for="">TIPO:</label>
                <input type="text" name="tipo">
                <label for="">VALOR:</label>
                <input type="string" name="valor">
                <label for="">EMPRESA</label>
                <select name="empresa_id" id="empresa_id">
                    @foreach ($empresas as empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->razao_social }}></option>
                    @endforeach
                </select>
                <label for=""> CATEGORIA:</label>
                <select name="categoria_id" id="categoria_id">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->tipo }}></option>
                    @endforeach
                </select>
                <label for="">Status</label>
                <select name="status" id="status">
                    <option value="1">Concluido</option>
                    <option value="0">EM andamento</option>
                </select>
            </form>
        </body>
</html>
