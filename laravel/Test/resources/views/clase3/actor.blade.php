@extends('../template')


@section('title', 'Actores')


@section('content')
    <h1>Datos del actor:</h1>
    <ul>
        @foreach($resultado as $key => $datos)
            <li>{{$key}}: {{$datos}}</li>
        @endforeach
    </ul>
    <a href="../actores">Volver al listado</a>
@endsection