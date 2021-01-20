@if(isset($fruta) && is_object($fruta))
    <h1>Editar fruta</h1>
@else
    <h1>Crear una fruta</h1>
@endif

<form method="POST" action="{{ isset($fruta) ? action('FrutaController@edit', ['id' => $fruta->id]) : action('FrutaController@save') }}">
    {{ csrf_field() }}
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="{{ $fruta->nombre ?? '' }}" />
    
    <br />
    
    <label for="precio">Precio</label>
    <input type="text" name="precio" placeholder="{{ $fruta->precio ?? '' }}" />
    
    <br />
    
    <label for="descripcion">Descripcion</label>
    <textarea name="descripcion" placeholder="{{ $fruta->descripcion ?? '' }}"></textarea>
    
    <br />
    
    <input type="submit" name="enviar" value="Enviar" />
</form>