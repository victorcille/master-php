<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;  // Cargamos el modelo para poder trabajar con los objetos y la bbdd

class LikeController extends Controller
{
    // Este middleware controlará que no se pueda acceder a ninguna acción (ruta URL) de las que nos hemos definido aquí sin estar logueados 
    public function __construct(){
        $this->middleware('auth');
    }
    
    // Método para listar las publicaciones likeadas del usuario
    public function index(){
        // Sacamos el usuario identificado
        $user = \Auth::user();
        
        // Sacamos el listado de todas los likes aplicando una paginación de 5 elementos por página
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(5);
        
        return view('like.index', [
            'likes' => $likes
        ]);
    }
    
    // Esta acción será llamada por AJAX una vez que pulsemos el icono del corazón (like)
    public function like($image_id){
        // Recogemos los datos del usuario identificado
        $user = \Auth::user();
        
        // Comprobamos si ya existe el like para no duplicarlo (que no se pueda dar 2 likes por la misma persona a la misma imagen)
        // ->count() me cuenta cuantos resultados me saca la consulta
        // ->get() me saca el resultado de la consulta
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();
        
        // Si no hay ningún like de ese usuario a esa imagen, entonces guardamos en bbdd
        if($isset_like == 0){
        
            // Creamos un objeto Like
            $like = new Like();

            // Asignamos los valores que va a tener el objeto
            $like->user_id = $user->id;
            $like->image_id = $image_id;

            // Guardamos en bbdd
            $like->save();
            
            // Como este método va a ser llamado por AJAX, vamos a devolver un JSON como respuesta
            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => "El usuario ya le ha dado like a esa publicación"
            ]);
        }
        
    }
    
    // Esta acción será llamada por AJAX una vez que pulsemos el icono del corazón (dislike)
    public function dislike($image_id){
        // Recogemos los datos del usuario identificado
        $user = \Auth::user();
        
        // Comprobamos si ya existe el like de ése usuario en ésa foto
        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();
        
        // Si existe,
        if($like){
            // Eliminamos el like
            $like->delete();
            
            // Como este método va a ser llamado por AJAX, vamos a devolver un JSON como respuesta
            return response()->json([
                'like' => $like,
                'message' => 'Esta publicación ya no te gusta'
            ]);
        }else{
            return response()->json([
                'message' => "El like no existe"
            ]);
        }
    }
}
