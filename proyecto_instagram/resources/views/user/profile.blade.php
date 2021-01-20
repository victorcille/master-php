@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="profile-user">
                @if($user->image)
                    <div class='container-avatar'>
                        <!--<img src="{{ url('/user/avatar/' . Auth::user()->image) }}" />-->
                        <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" />
                    </div>
                @endif
                
                <div class="user-info">
                    <h1>{{ $user->nick }}</h1>
                    <h2>{{ $user->name . " " . $user->surname }}</h2>
                    <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>
                </div>
            </div>
            
            <hr />
            
            {{-- Mostramos el listado de imágenes --}}
            @foreach($user->images as $image)
            
                {{-- Con los includes también se pueden pasar variables. Llamamos a la vista que muestra la tarjeta de una imagen --}}
                @include('includes.image', ['image' => $image])
                
            @endforeach
            
            
        </div>
    </div>
</div>
@endsection
