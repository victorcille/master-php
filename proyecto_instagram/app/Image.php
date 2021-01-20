<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';  // Con esta propiedad le especificamos al modelo el nombre de la tabla de la base de datos que va a modificar
    
    // Relación oneToMany con Comentarios (una imagen puede tener muchos comentarios)
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');  // Le aplicamos un order by para que saque de más nuevo a más viejo
    }
    
    // Relación oneToMany con Likes (una imagen puede tener muchos likes)
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    // Relación manyToOne con Usuarios (un usuario puede tener muchas imágenes)
    // Estos métodos que hemos hecho donde especificamos las relaciones, eloquent (el ORM de Laravel) luego lo convertirá automáticamente 
    // a propiedades, de tal manera que si yo tengo un objeto $image podré sacar su usuario haciendo por ejemplo $image->user->name
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
