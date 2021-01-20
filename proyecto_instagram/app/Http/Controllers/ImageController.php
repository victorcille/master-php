<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Image;  // Cargamos el modelo de la clase Image para poder trabajar con ellos y la base de datos
use App\Comment;
use App\Like;

// Necesario importar estas clases para poder trabajar con las imágenes subidas en el formulario
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    // Este middleware controlará que no se pueda acceder a ninguna acción (ruta URL) de las que nos hemos definido aquí sin estar logueados 
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function create(){
        return view('image.create');
    }
    
    public function save(Request $request){
        // Validamos los datos que nos llegan del formulario ($request)
        $validate = $this->validate($request, [
            'image_path' => ['required', 'image'],  // en vez de 'image' también podíamos haber metido la regla 'mimes:jpg,jpeg,png,gif'
            'description' => ['required'],
        ]);
        
        // Recogemos los datos que nos llegan por POST del formulario renderizado en el método anterior
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        // Conseguimos el id del usuario identificado
        $userId = \Auth::user()->id;
        
        // Asignamos los nuevos valores al objeto imagen
        $image = new Image();
        $image->user_id = $userId;
        $image->description = $description;
        
        // Subir la imagen
        if($image_path){
            // Hacemos que el nombre de la imagen sea único concatenándole la fecha 
            $image_name = time() . $image_path->getClientOriginalName();
            
            // Guardamos la imagen en el fichero storage/app/images definido en el apartado 'disk' del fichero config/filesystems.php
            // Al método put() le tenemos que pasar como primer parámetro el nombre que va a tener el archivo y como segundo el fichero en sí
            // utilizando el método get() del objeto File.
            Storage::disk('images')->put($image_name, File::get($image_path));
            
            // Asignamos el valor de la propiedad image_path al objeto $image
            $image->image_path = $image_name;
        }
        
        // Guardamos en bbdd
        $image->save();
        
        return redirect()->route('home')
                         ->with([
                             'message' => 'Imagen subida correctamente'
                        ]);
    }
    
    // Método que devuelve la imagen que le pasamos por la url del directorio de images (para mostrarlas en la home por ejemplo) 
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        
        return new Response($file, 200);
    }
    
    // Método que devuelve el detalle de la imagen que le pasamos por la url
    public function detail($id){
        $image = Image::find($id);  // Sacamos la información del objeto de la bbdd buscando por su id
        
        return view('image.detail', [
            'image' => $image
        ]);
    }
    
    public function delete($id){
        $user = \Auth::user();
        
        $image = Image::find($id);  // Sacamos la información del objeto de la bbdd buscando por su id
        
        // Como en la elaboración de la bbdd no pusimos el ON DELETE CASCADE, antes de borrar la imagen debemos borrar los likes y comentarios
        // asociados a esa imagen
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        
        // Si el usuario identificado es el dueño de la publicación y existe la imagen
        if($user && $user->id == $image->user_id && $image){
            // Eliminamos los comentarios asociados a la imagen
            if($comments && count($comments) > 0){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }
            
            // Eliminamos los likes asociados a la imagen
            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }
            
            // Eliminamos el fichero almacenado en el storage
            Storage::disk('images')->delete($image->image_path);
            
            // Eliminamos el registro de la imagen de la bbdd
            $image->delete();
            
            $message = array('message' => 'La imagen se ha borrado correctamente');
        }else{
            $message = array('message' => 'La imagen no se ha borrado');
        }
        
        return redirect()->route('home')->with($message);
    }
    
    public function edit($id){
        $user = \Auth::user();
        
        $image = Image::find($id);  // Sacamos la información del objeto de la bbdd buscando por su id
        
        if($user && $user->id == $image->user_id && $image){
            return view('image.edit', [
                'image' => $image
            ]);
        }else{
            return redirect()->route('home');
        }
    }
    
    public function update(Request $request){
        // Validamos los datos que nos llegan del formulario ($request)
        $validate = $this->validate($request, [
            'image_path' => ['image'],  // en vez de 'image' también podíamos haber metido la regla 'mimes:jpg,jpeg,png,gif'
            'description' => ['required'],
        ]);
        
        // Recogemos los datos que nos llegan por POST del formulario renderizado en el método anterior
        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        
        // Conseguimos el id del usuario identificado
        $userId = \Auth::user()->id;
        
        // Conseguimos el objeto image de la bbdd
        $image = Image::find($image_id);
        
        // Asignamos los nuevos valores al objeto imagen
        $image->user_id = $userId;
        $image->description = $description;
        
         // Subir la imagen
        if($image_path){
            // Hacemos que el nombre de la imagen sea único concatenándole la fecha 
            $image_name = time() . $image_path->getClientOriginalName();
            
            // Guardamos la imagen en el fichero storage/app/images definido en el apartado 'disk' del fichero config/filesystems.php
            // Al método put() le tenemos que pasar como primer parámetro el nombre que va a tener el archivo y como segundo el fichero en sí
            // utilizando el método get() del objeto File.
            Storage::disk('images')->put($image_name, File::get($image_path));
            
            // Asignamos el valor de la propiedad image_path al objeto $image
            $image->image_path = $image_name;
        }
        
        // Actualizamos registro en la bbdd
        $image->update();
        
        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Publicación actualizada con éxito']);
    }
}
