{{-- Si el usuario identificado tiene imagen de avatar, lo mostramos. 
    En el src llamaremos a la ruta que nos hemos creado que devuelve una respuesta con la imagen del avatar del usuario.
    Podemos usar el método url() para indicarle la url o podemos usar el método route y pasarle el nombre de la ruta --}}
@if(Auth::user()->image)
    <div class='container-avatar'>
        <!--<img src="{{ url('/user/avatar/' . Auth::user()->image) }}" />-->
        <img src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" class="avatar" />
    </div>
@endif