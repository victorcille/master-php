<?php

// Un trait nos permite definir una serie de métodos para que sean compartidos por distintas clases independientes sin necesidad de la herencia
trait Utilidades{
    public function mostarNombre(){
        return "<h1>El nombre es: " . $this->nombre . "</h1>";
    }
}

class Coche{
    public $nombre;
    public $modelo;
    
    // Para usar el trait que he defiido más arriba en esta clase debemos hacerlo así:
    use Utilidades;
    
    // El método toString() nos brinda la posibilidad de devolver el texto que queramos si decidimo imprimir por pantalla el objeto directamente (no un método o atributo concreto)
    public function __toString() {
        return "Este es un objeto de tipo Coche cuyo nombre es {$this->nombre}";
    }
}

class Persona{
    public $nombre;
    public $apellidos;
    
    // Para usar el trait que he defiido más arriba en esta clase debemos hacerlo así:
    use Utilidades;
    
    // El método toString() nos brinda la posibilidad de devolver el texto que queramos si decidimo imprimir por pantalla el objeto directamente (no un método o atributo concreto)
    public function __toString() {
        return "Este es un objeto de tipo Persona cuyo nombre es {$this->nombre}";
    }
}

class Videojuego{
    public $nombre;
    public $anioPublicacion;
    
    // Para usar el trait que he defiido más arriba en esta clase debemos hacerlo así:
    use Utilidades;
    
    // El método toString() nos brinda la posibilidad de devolver el texto que queramos si decidimo imprimir por pantalla el objeto directamente (no un método o atributo concreto)
    public function __toString() {
        return "Este es un objeto de tipo Videojuego cuyo nombre es {$this->nombre}";
    }
}


$coche = new Coche();
$persona = new Persona();
$videojuego = new Videojuego();

$coche->nombre = "Audi";
$persona->nombre = "Víctor";
$videojuego->nombre = "Fifa 21";

// Uso del trait
echo $coche->mostarNombre();
echo $persona->mostarNombre();
echo $videojuego->mostarNombre();

// Uso del método toString: Como hemos definido un método toString en cada una de las clases, podemos imprimir por pantalla sin problema el objeto de esa clase
echo "<h1>$coche</h1>";
echo "<h1>$persona</h1>";
echo "<h1>$videojuego</h1>";