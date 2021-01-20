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

// RUTAS GENERALES
Auth::routes();
// Modificamos el /home que por defecto nos hace por la raíz (/)
Route::get('/', 'HomeController@index')->name('home');


// RUTAS DE USUARIO
Route::get('/configuracion', 'UserController@config')->name('config');  // Ruta donde se mostrará el formulario para cambiar datos de un usuario
Route::post('/user/update', 'UserController@update')->name('user.update');  // Ruta que recibirá los parámetros del formulario de la ruta anterior
Route::get('/profile/{user_id}', 'UserController@profile')->name('profile');
// Ruta para obtener el avatar de un usuario. Esta url la usaremos en la/s plantilla/s para pasárselo al src de una etiqueta <img> y poder así mostrarla
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/users/{search?}', 'UserController@index')->name('users.index');  // El parámetro search es opcional


// RUTAS DE IMAGEN
Route::get('/image/create', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');  // Ruta que recibirá los parámetros del formulario de la ruta anterior
Route::get('/image/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');
// Ruta para obtener una imagen de la carpeta images. Le pasaremos el nombre de la imagen por la url
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');


// RUTAS DE COMENTARIO
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');


// RUTAS DE LIKE
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
// Ruta para mostrar todas las publicaciones likeadas por el usuario
Route::get('/likes', 'LikeController@index')->name('likes');