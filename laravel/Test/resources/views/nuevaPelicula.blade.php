<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Película Agregada</title>
</head>
<body>
    <h1>Película agregada con éxito</h1>
    <h2>Datos de la nueva película:</h2>
    <ul>
        @foreach($peliculas as $index => $dato)
            <li>{{$index}}: {{$dato}}</li>
        @endforeach
    </ul>
    <a href="agregarPelicula">Cargar una nueva película</a>
</body>
</html>