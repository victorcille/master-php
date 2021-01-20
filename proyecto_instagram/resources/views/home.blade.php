@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @include('includes.message')
            
            {{-- Mostramos el listado de imágenes --}}
            @foreach($images as $image)
            
                {{-- Con los includes también se pueden pasar variables. Llamamos a la vista que muestra la tarjeta de una imagen --}}
                @include('includes.image', ['image' => $image])
                
            @endforeach
            
            {{-- Añadimos los enlaces de la paginación --}}
            <div class="clearfix"></div>
            {{ $images->links() }}
        </div>
    </div>
</div>
@endsection
