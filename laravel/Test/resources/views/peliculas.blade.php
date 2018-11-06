<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Peliculas</title>
</head>
<body>
    @if (is_array($resultado))
    <h1>Listado de Películas</h1>
    <ul>
        @foreach($resultado as $peliculas)
            <li>{{$peliculas}}</li>
        @endforeach
    </ul>
    @else
    <h1>Resultado de la búsqueda:</h1>
    <h2>{{$resultado}}</h2>
    @endif
</body>
</html>