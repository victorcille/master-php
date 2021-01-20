<h1>Formulario en Laravel</h1>
<form method="POST" action="{{ action('PruebasController@recibirDatos') }}">
    {{-- esta función es importante que se la añadamos a los formularios porque si no, vamos a obtener un error 419. Esto es debido
        a la seguridad interna que Laravel da a los formularios para protegerlos contra ataques --}}
    
    {{ csrf_field() }}
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" />
    
    <br />
    
    <label for="email">Email</label>
    <input type="email" name="email" />
    
    <br />
    
    <input type="submit" name="enviar" value="Enviar" />
</form>