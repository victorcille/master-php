<!-- IMPORTAR VISTAS (INCLUDE) -->
@include('includes.header')

<hr />

<!-- COMENTARIOS EN BLADE -->
{{-- Así se ponen comentarios en blade --}}

<!-- IMPRIMIR POR PANTALLA -->
<h1>{{ $titulo }}</h1>

<!-- CONDICIONALES -->
@if($titulo && count($peliculas) > 5)
    <p>El título existe y el listado de películas ES MAYOR a 5</p>
@elseif($titulo && count($peliculas) > 0)
    <p>El título existe y el listado de películas ES MAYOR a 0 Y MENOR a 5</p>
@else
    <p>Las condiciones no se cumplen</p>
@endif

<hr />

<!-- BUCLE FOR -->
@for($i = 0; $i <= 10; $i++)
    {{ $i }} <br />
@endfor

<hr />

<!-- BUCLE WHILE -->
<?php $j = 1; ?>
@while($j <= 15)
    {{ $j }} <br />
    <?php $j++; ?>
@endwhile

<hr />

<!-- BUCLE FOREACH -->
<ul>
    @foreach($peliculas as $pelicula)
        <li>{{ $pelicula }}</li>
    @endforeach
</ul>

<hr />

<!-- Equivalencias entre php y blade -->

<!-- MOSTRAR SI EXISTE (ISSET) -->
<!--<?= isset($director)? $director : 'No existe la variable director' ?>-->
{{ $director ?? 'No existe la variable director' }}

<hr />

@include('includes.footer')