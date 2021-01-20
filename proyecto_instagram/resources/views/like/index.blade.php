@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Mis imágenes favoritas</h1>
            <hr />
            
            {{-- Mostramos el listado de imágenes --}}
            @foreach($likes as $like)
            
                {{-- Con los includes también se pueden pasar variables. Llamamos a la vista que muestra la tarjeta de una imagen --}}
                @include('includes.image', ['image' => $like->image])
                
            @endforeach
            
            {{-- Añadimos los enlaces de la paginación --}}
            <div class="clearfix"></div>
            {{ $likes->links() }}
        </div>
    </div>
</div>
@endsection
