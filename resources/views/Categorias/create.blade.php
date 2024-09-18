<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Cadastro Categoria </title>
    </head>
    <body>
        <h1>Nova Categoria</h1>
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <label for="">TIPO</label>
            <input type="text" name="tipo" id="tipo">
            <button type="submit">Salvar</button>
        </form>
    </body>
</html>
