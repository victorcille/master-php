<?php
// Fichero creado automáticamente al hacer el comando php bin/console make:twig-extension MiFiltro
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MiFiltroExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('multiplicar', [$this, 'multiplicar']),  // Cambiamos el filter_name y el doSomething por multiplicar
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('multiplicar', [$this, 'multiplicar']),  // Cambiamos el function_name y el doSomething por multiplicar
        ];
    }
    
    // Esta función por defecto se llama doSomething(). 
    // Le he cambiado el nombre para customizarla y que el nombre sea representativo de lo que va a hacer
    public function multiplicar($numero)
    {
        $tabla = "<h1>Tabla del $numero:</h1>";
        
        for($i = 1; $i <= 10; $i++){
            $tabla.= "$i x $numero = " . ($i*$numero) . "<br />";
        }
        
        return $tabla;
    }
}
