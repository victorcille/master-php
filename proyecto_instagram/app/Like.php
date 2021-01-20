<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';  // Con esta propiedad le especificamos al modelo el nombre de la tabla de la base de datos que va a modificar
    
    // Relación manyToOne con Imagenes (una imagen puede tener muchos likes)
    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
    
    // Relación manyToOne con Usuarios (un usuario puede tener muchos likes)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
