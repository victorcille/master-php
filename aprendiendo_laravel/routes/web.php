<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

/*


// Ruta de muestra para ensayar un poco (primeros pasos)
Route::get('/mostrar_fecha', function(){
    $titulo = "Estoy mostrando la fecha de hoy";
    
    return view('mostrar_fecha', array(  // Además de cargar vistas, se le pueden pasar parámetros
        "titulo" => $titulo
    ));
});

// Ruta de ejemplo de cómo se pasan parámetros por la url. Lo recogemos como parámetro en la función y se lo pasamos a la vista
// Si metemos el nombre del parámetro dentro de las llaves hacemos que sea obligatorio el que se lo tengamos que pasar
// Si le ponemos un interrogante (?) hacemos que sea opcional el que se lo tengamos que pasar. Para ello le damos un valor por defecto
Route::get('/pelicula/{id}/{titulo?}', function($id, $titulo = "Película undefined"){
    
    // Cuando el fichero se encuentra dentro de un directorio (en este caso peliculas/pelicula.blade.php), 
    // la forma de indicarle dónde se encuentra es directorio.nombre_del_fichero
    return view('peliculas.pelicula', array(
        "id" => $id,
        "titulo" => $titulo
    ));
});

// Otra forma de pasarle parámetros a la vista es con el método with(). Ejemplo
Route::get('/listado-peliculas', function(){
    
    $titulo = "Listado de películas";
    $peliculas = array('Batman vs Superman', 'Spiderman', 'Antman', 'Ironman', 'Black Panther');
    
    return view('peliculas.listado')
        ->with('titulo', $titulo)
        ->with('peliculas', $peliculas);
});

// También se pueden definir condiciones (->where) para que se pueda acceder a la ruta y si no se cumplen, que no se pueda acceder
// En este caso vemos que el id debe ser un número y nombre ha de ser texto (mediante expresiones regulares)
Route::get('/usuario/{id}/{nombre}', function($id, $nombre){
        
    return view('usuario', array(
        "id" => $id,
        "nombre" => $nombre
    ));
})->where(array(
    'id' => '[0-9]+',
    'nombre' => '[A-Za-z ]+'
));

// Ruta para hacer un ejemplo de cómo usar las plantillas maestras (se define en una plantilla maestra distintos bloques que serán desarrollados 
// a su vez por otras vistas y así)
Route::get('/pagina_generica', function () {
    return view('pagina');
});


*/

/////////////////////////////////////////////////////////////////////////////////////////////

// Hasta aquí las pruebas. 
// Lo óptimo es que en este fichero de rutas se indique el controlador y la función a la que estará asociada dicha ruta
// Y que sea el controlador el que ejecute toda la lógica que haya que hacer y que devuelva en su caso la vista correspondiente, o una
// redirección o lo que sea.

/*
// Esta forma de definir la ruta con el uses es para especificar la acción del controlador y el as es para definir el nombre de esa ruta
// (columna 'Name' de la tabla que aparece al meter el comando "php artisan route:list"). Los nombres son útiles por ejemplo al hacer enlaces
// para pasárselos al href de la forma href="{{ route('name_de_la_ruta') }}"
Route::get('/pruebas/{titulo}', [
    'uses' => 'PruebasController@showTitle',
    'as' => 'pruebas.titulo'
]);
*/

Route::get('/pruebas', [
    'uses' => 'PruebasController@index',
    'as' => 'pruebas.index'
]);

// Ruta asociadas a un controlador de tipo resource (hecho con la consola con el comando correspondiente) donde las acciones ya están 
// definidas automáticcamente por Laravel 
Route::resource('alumno', 'AlumnoController');

// Ruta de ejemplo de cómo se hacen enlaces en Laravel (ver la vista que el controlador renderiza)
Route::get('/pruebas/detalle', 'PruebasController@detalle');

// Ruta de ejemplo de cómo se hacen redirecciones directamente desde una acción de un controlador a otra
Route::get('/pruebas/redireccion', 'PruebasController@redireccion');


// Un middleware es un componente que nos permite filtrar las peticiones que nosotros hacemos mediante http.
// El middleware (filtro) será una clase php que se ejecutará antes que la acción de un controlador de manera que podemos evaluar ciertas cosas y si no
// se cumplen, que no se ejecute la acción del controlador asociada a esa ruta
// En este caso comprobaremos con el middleware si el parámetro 'param' nos llega por la url. Si nos llega le dejaremos pasar a la acción del
// controlador y si no, redirecciona. Para hacer el middleware tenemos que meter el comando 'php artisan make:middleware nombre_del_middleware'
// La clase del middleware que hayamos creado se alamcenará en la carpeta Http/Middleware
Route::get('/pruebas/middleware/{param?}', [
    'middleware' => 'testparam',
    'uses' => 'PruebasController@middlewareEjemplo',
    'as' => 'pruebas.middleware'
]);

// Ejemplos de cómo hacer y posteriormente recoger los datos de un formulario
Route::get('/pruebas/formulario', 'PruebasController@formulario');  // Esta ruta sería la que renderiza el formulario
// Como esta es la ruta que recibe los datos y en el formulario hemos indicado que es un método POST, lo indicamos en el Route::post
Route::post('/pruebas/recibir', 'PruebasController@recibirDatos');




Route::get('/frutas', 'FrutaController@index');
Route::get('/fruta/detalle/{id}', 'FrutaController@detail');
Route::get('/fruta/create', 'FrutaController@create');
Route::post('/fruta/save', 'FrutaController@save');
Route::get('/fruta/delete/{id}', 'FrutaController@delete');
Route::get('/fruta/update/{id}', 'FrutaController@update');
Route::post('/fruta/edit/{id}', 'FrutaController@edit');