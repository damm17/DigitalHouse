@extends('../template')


@section('title', 'Actores')


@section('content')
    @if (!is_array($resultado))
       <p>{{$resultado}}</p>
    @elseif (isset($resultado[0]))
        <ol>
        @foreach($resultado as $actores)
            <li><a href="actors/{{$actores['id']}}">{{ $actores['first_name'] }} {{ $actores['last_name'] }}</a></li>
        @endforeach
        </ol>
    @else
        <ul>
            <li>Nombre: {{ $resultado["first_name"] }}</li>
            <li>Apellido: {{ $resultado["last_name"] }}</li>
            <li>Rating: {{ $resultado["rating"] }}</li>
        </ul>
        <a href="../actors">Volver al listado</a>
    @endif
@endsection