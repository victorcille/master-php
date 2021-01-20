@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gente</h1>
            <form method="GET" action="{{ route('users.index') }}" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input id="search" type="text" class="form-control" autofocus />
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="btn btn-primary" />
                    </div>
                </div>
            </form>
            <hr />
            
            {{-- Mostramos el listado de usuarios --}}
            @foreach($users as $user)
            
                <div class="profile-user">
                    @if($user->image)
                        <div class='container-avatar'>
                            <!--<img src="{{ url('/user/avatar/' . Auth::user()->image) }}" />-->
                            <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" class="avatar" />
                        </div>
                    @endif

                    <div class="user-info">
                        <h2>{{ $user->nick }}</h2>
                        <h3>{{ $user->name . " " . $user->surname }}</h3>
                        <p>{{ 'Se unió: ' . \FormatTime::LongTimeFilter($user->created_at) }}</p>
                        <a href="{{ route('profile', ['user_id' => $user->id]) }}" class="btn btn-primary">Ver perfil</a>
                    </div>
                </div>
            
                <div class="clearfix"></div>
                <hr />
            @endforeach
            
            {{-- Añadimos los enlaces de la paginación --}}
            <div class="clearfix"></div>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
