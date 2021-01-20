<h1>Detalle de la fruta: {{ $fruta->nombre }}</h1>
<p>{{ $fruta->descripcion }}</p>
<a href="{{ action('FrutaController@delete', ['id' => $fruta->id]) }}">Borrar fruta</a>
<br />
<a href="{{ action('FrutaController@update', ['id' => $fruta->id]) }}">Editar fruta</a>

