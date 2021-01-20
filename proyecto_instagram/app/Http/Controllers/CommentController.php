<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;  // Importamos el modelo de Comment

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function save(Request $request){
        
        // Validamos los datos que nos vienen del formulario
        $validate = $this->validate($request, [
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string']
        ]);
        
        // Recogemos los datos que nos vienen por POST
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        $user = \Auth::user();
        $user_id = $user->id;
        
        // Nos creamos un objeto de tipo Comment
        $comment = new Comment();
        
        // Asignamos los nuevos valores al objeto
        $comment->user_id = $user_id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        // Guardamos en bbdd
        $comment->save();
        
        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with([
                             'message' => 'Has publicado tu comentario correctamente'
                        ]);
    }
    
    public function delete($id){
        // Conseguimos los datos del usuario identificado
        $user = \Auth::user();
        
        // Conseguimos el comentario con ese id
        $comment = Comment::find($id);
        
        // Comprobamos si el usuario identificado es el dueño del comentario o si es el dueño de la publicación (imagen) 
        if($user && ($user->id == $comment->user_id || $user->id == $comment->image->user_id)){
            // Si es así, lo borramos
            $comment->delete();
            $message = 'Comentario eliminado correctamente';
        }else{
            $message = 'EL COMENTARIO NO SE HA ELIMINADO!!';
        }
        
        return redirect()->route('image.detail', ['id' => $comment->image_id])
                         ->with([
                             'message' => $message
                        ]);
    }
}
