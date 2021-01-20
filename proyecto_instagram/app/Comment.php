<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';  // Con esta propiedad le especificamos al modelo el nombre de la tabla de la base de datos que va a modificar
    
    // Relación manyToOne con Imagenes (una imagen puede tener muchos comentarios)
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
    
    // Relación manyToOne con Usuarios (un usuario puede tener muchas imágenes)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
