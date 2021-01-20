<?php
// Controlador de ejemplo para ver cómo se usa el queryBuilder de Laravel y sacar datos de la bbdd 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Necesario importar esta clase para trabajar con la base de datos

class FrutaController extends Controller
{
    // Función que listará los datos de la tabla frutas
    public function index(){
        $frutas = DB::table('frutas')
                ->orderBy('id', 'desc')
                ->get();
        
        return view('frutas.index', [
            'frutasArray' => $frutas  // El nombre que le ponemos al índice es la variable que tendremos disponible en la vista, en este caso $frutas
        ]);
    }
    
    public function detail($id){
        // Así se utiliza el where. En el primer parámetro le indico qué columna quiero evaluar, en el segundo parámetro el operador que utilizo
        // y en el tercer parámetro el valor que quiero sacar (en este caso que me llega por la url).
        // Si usamos el get() nos saca un array de un sólo elemento. Si queremos que nos saque el objeto limpio directamente (no un array),
        // usamos el first()
        $fruta = DB::table('frutas')->where('id', '=', $id)->first();
        
        return view('frutas.detail', [
            'fruta' => $fruta
        ]);
    }
    
    public function create(){
        return view ('frutas.create');
    }
    
    // Función que recibe los datos por post del formulario que hay en la plantilla create (accion anterior) y los inserta en la tabla frutas
    public function save(Request $request){
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        
        // Insertamos un registro nuevo en la base de datos con los datos que nos llegan del formulario
        $fruta = DB::table('frutas')->insert(array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fecha' => date('Y-m-d')
        ));
        
        // Al pasarle el with() en el redirect estamos haciendo un mensaje/session flash que podemos recoger en la vista con 
        // session('nombre_de_la_session'), en este caso session('status')
        return redirect()->action('FrutaController@index')->with('status', 'Fruta creada correctamente');
    }
    
    public function delete($id){
        $fruta = DB::table('frutas')->where('id', $id)->delete();
        
        return redirect()->action('FrutaController@index')->with('status', 'Fruta eliminada correctamente');
    }
    
    public function update($id){
        // Sacamos el objeto de la bbdd y se lo pasamos a la vista
        $fruta = DB::table('frutas')->where('id', $id)->first();
        
        // Reutilizamos la vista del create
        return view ('frutas.create', [
            'fruta' => $fruta
        ]);
        
    }
    
    public function edit($id, Request $request){
        $nombre = $request->input('nombre');
        $descripcion = $request->input('descripcion');
        $precio = $request->input('precio');
        
        $fruta = DB::table('frutas')->where('id', $id)->update(array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio
        ));
        
        return redirect()->action('FrutaController@index')->with('status', 'Fruta editada correctamente');
    }
    
}
