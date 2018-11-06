@extends('../template')


@section('title', 'Actores')


@section('content')
    <ol>
        @foreach($resultado as $actor)
            <li><a href="actor/{{$actor['id']}}">{{ $actor['first_name'] }} {{ $actor['last_name'] }}</a></li>
        @endforeach
    </ol>
@endsection