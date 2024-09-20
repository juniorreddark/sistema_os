<!DOCTYPE html>
<html>
    <head>
        <title>Lista de Servico</title>
    </head>
    <body>
        <button><a href="{{ route('pagina_inicial') }}">Página Inicial</a></button>
        <h1>Serviços</h1>
        <form action="{{ route('servico.index') }}" method="POST">
            @csrf
            <label for="">TIPO</label>
            <input type="text" name="tipo" id="tipo">
            <label for="">VALOR R$:</label>
            <input type="text" name="valor" id="valor">
            <label for="">EMPRESA</label>
           <select name="empresa_id" name="empresa_id" id="">
            @foreach ($empresas as $empresa)
                <option value="{{ $empresa->id }}">{{ $empresa->razao_social }}></option>

            @endforeach
           </select>
           <label for="">CATEGORIA</label>
            
        </form>
    </body>
</html>
