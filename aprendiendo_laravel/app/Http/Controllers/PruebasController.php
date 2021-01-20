<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function index(){
        $titulo = "Título de prueba";
        return view('pruebas.index')
            ->with('titulo', $titulo);
    }
    
    // Método del controlador que recibe el título por parámetro desde la URL (mirar fichero routes/web.pp)
    public function showTitle($titulo){
        return view('pruebas.showTitle')
            ->with('titulo', $titulo);
    }
    
    public function detalle(){
        // En esta vista se ve cómo se usan los enlaces en Laravel
        return view('pruebas.detalle');
    }
    
    // Función de ejemplo para ver cómo se hace una redirección en Laravel. Esta acción me redirige automáticamente a detalle()
    public function redireccion(){
        // Pasa un poco como los enlaces. Hay varias formas de hacerlo
        
        // Esta es una
        // return redirect()->action('PruebasController@detalle');
        
        // Esta es otra
        return redirect()->route('pruebas.index');
    }
    
    // Función de ejemplo de cómo se hacen y se usan los middlewares. En este caso, esta acción sólo se ejecutará si pasamos el middleware
    // Ver el fichero Http/Middleware/TestParam.php para ver que si no se pasa un param por la url, se redrecciona a index()
    // En el fichero de rutas (web.php) se especifica que para la ruta /pruebas/middleware/{param?}, se debe aplicar el middleware TestParam
    public function middlewareEjemplo($param = null){
        echo "Has pasado el middleware ya que has indicado el parámetro $param en la url";
    }
    
    // Acción que renderiza la plantilla con el formulario
    public function formulario(){
        return view('pruebas.formulario');
    }
    
    // Acción que recibe los datos que nos llegan por el formulario
    // Cuando vamos a recibir datos por POST debemos pasarle un parámetro request de tipo Request al método
    public function recibirDatos(Request $request){
        $nombre = $request->input('nombre');  // Así recogemos los campos que nos llegan del formulario
        $email = $request->input('email');
        dd($nombre, $email);
    }
}
