<h1>Listado de frutas</h1>

{{-- Así se tratan los mensajes flash --}}
@if(session('status'))
    <p style='background: green; color: white;'>
        {{ session('status') }}
    </p>
@endif

<ul>
    @foreach($frutasArray as $fruta)
        {{-- Así pasamos parámetros cuando llamamos a una acción que debe recibirlos --}}
        <li><a href="{{ action('FrutaController@detail', ['id' => $fruta->id]) }}">{{ $fruta->nombre }}</a></li>
    @endforeach
</ul>