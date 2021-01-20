<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;  // Importamos el modelo de Imagen para poder utilizarlo en el método que saca el listado de imágenes

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Sacamos el listado de todas las imágenes aplicando una paginación de 5 elementos por página
        $images = Image::orderBy('id', 'desc')->paginate(5);
        
        return view('home', [
            'images' => $images
        ]);
    }
}
