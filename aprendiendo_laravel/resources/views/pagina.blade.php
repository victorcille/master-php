{{-- Esta sentencia nos ayuda a decirle a una vista cual va a ser el template que se va a usar (cual es el padre o de cual hereda) --}}
@extends('layouts.master')

{{-- Sustituimos el yield del title que hemos definido en el padre --}}
@section('titulo', 'Master en PHP')

{{-- Si además de lo que hay en el padre, queremos añadir contenido (no sustituirlo sino añadir más cosas) usamos el @parent() --}}
@section('header')
    @parent()
    <h2>Contenido añadido al padre desde el hijo</h2>
@stop

{{-- Sustituimos el bloque section de la plantilla padre --}}
@section('content')
    <h3>Contenido de la página genérica</h3>
@stop