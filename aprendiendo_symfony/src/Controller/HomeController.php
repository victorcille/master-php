<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function index(){
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'saludo' => 'Hola mundo desde Symfony 5'
        ]);
    }
    
    public function animales($nombre, $edad){
        $title = "Bienvenido a la página de animales";
        
        // Array normal
        $animales = ["Perro", "Gato", "Caballo", "Oveja", "Cerdo"];
        
        // Array asociativo
        $jugadores = [
            'portero' => "Oblak", 
            'defensa' => "Savic", 
            'medio' => "Saúl", 
            'delantero' => "Costa"
        ];
        
        return $this->render('home/animales.html.twig', [
            'title' => $title,
            'nombre' => $nombre,
            'edad' => $edad,
            'animales' => $animales,
            'jugadores' => $jugadores
        ]);
    }
    
    public function redirigir(){
        // 1ª Forma: Con el redirectToRoute() y pasándole el nombre (name) de la ruta
        //return $this->redirectToRoute('index');
        
        // 2ª Forma: Pasándole parámetros por la url
        /*
        return $this->redirectToRoute('animales', [
            'nombre' => 'Paco',
            'edad' => 44
        ]);
        */
        
        // 3ª Forma: Con el método redirect() pasándole por parámetro la url entera
        return $this->redirect('http://aprendiendo_symfony.com.devel/inicio');
    }
}
