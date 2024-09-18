<!DOCTYPE html>
<html>
    <head>
        <title>Categorias</title>
    </head>
    <body>
        <button><a href="http://127.0.0.1:8000/">Página Inicial</a></button>
        <form action="{{ route('categorias.index') }}" method="post">
            @csrf
            <label for="">Tipo</label>
            <input type="text" name="tipo" id="tipo">
            <button type="submit">Salvar</button>
        </form>
        @if (session('success'))
            <div>{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">TIPO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <th scope="row">{{ $categoria->id }}</th>
                        <td>{{ $categoria->tipo }}</td>
                        <td>
                            <button><a href="{{ route('categorias.edit', $categoria->id) }}">Editar</a></button>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </body>
</html>
