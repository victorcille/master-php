<h1>DETALLE</h1>

{{-- Esta es una forma de hacer un enlace en Laravel --}}
<a href="{{ action('PruebasController@index') }}">Ir al índice</a>

<hr />

{{-- Esta es otra forma de hacer un enlace en Laravel (necesario que la ruta tenga el mismo name asignado que le estamos pasando al href) --}}
<a href="{{ route('pruebas.index') }}">Otra forma de ir al índice</a>