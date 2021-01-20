<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

// Necesario importar estas clases para poder trabajar con las imágenes subidas en el formulario
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\User;  // Cargamos el modelo de User para poder trabajar con la bbdd

class UserController extends Controller
{
    // Este middleware controlará que no se pueda acceder a ninguna acción (ruta URL) de las que nos hemos definido aquí sin estar logueados 
    public function __construct(){
        $this->middleware('auth');
    }
    
    // Accion para listar todos los perfiles de usuarios
    public function index($search = null){
        if($search){  // Si nos viene el parámetro $search, hacemos una búsqueda de los usuarios por su nick o su nombre haciendo un like
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                    ->orWhere('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('surname', 'LIKE', '%'.$search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        }else{  // Si no, sacamos todos
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        
        return view('user.index', [
            'users' => $users
        ]);
    }
    
    public function config(){
        return view('user.config');
    }
    
    public function update(Request $request){
        // Conseguimos el usuario identificado
        $user = \Auth::user();
        $userId = $user->id;  // Recogemos el id del usuario identificado
        
        // Validamos los datos que nos llegan del formulario ($request)
        // La parte del final de nick y de email significa:
        // que el nick/email sea único en la tabla users con la excepción del suyo mismo (es decir, que si no lo modifican no devuelva un error)
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $userId],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
        ]);
        
        // Recogemos los datos que nos llegan por POST del formulario renderizado en el método anterior
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $image = $request->file('image');  // Así se recogen archivos en Laravel
        
        // Asignamos los nuevos valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        // Subir la imagen
        if($image){
            // Hacemos que el nombre de la imagen sea único concatenándole la fecha 
            $image_name = time() . $image->getClientOriginalName();
            
            // Guardamos la imagen en el fichero storage/app/users definido en el apartado 'disk' del fichero config/filesystems.php
            // Al método put() le tenemos que pasar como primer parámetro el nombre que va a tener el archivo y como segundo el fichero en sí
            // utilizando el método get() del objeto File.
            Storage::disk('users')->put($image_name, File::get($image));
            
            // Asignamos el valor de la propiedad imagen al usuario
            $user->image = $image_name;
        }
        
        // Guardamos en bbdd
        $user->update();
        
        return redirect()->route('config')
                         ->with([
                             'message' => 'Datos actualizados correctamente'
                        ]);
    }
    
    // Método para obtener la imagen del avatar del usuario. Este método ni renderiza ni redirecciona, sólo devuelve una respuesta con la imagen 
    public function getImage($filename){
        
        // Accedemos al storage y obtenemos la imagen
        $file = Storage::disk('users')->get($filename);
        
        return new Response($file, 200);
    }
    
    // Acción que muestra la plantilla del perfil del usuario
    public function profile($user_id){
        // Buscamos los datos del usuario en la bbdd según el id que nos viene por la url
        $user = User::find($user_id);
        
        return view('user.profile', [
            'user' => $user
        ]);
    }
}
