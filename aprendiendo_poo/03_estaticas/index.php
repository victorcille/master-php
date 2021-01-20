<?php
require_once './configuracion.php';

// Como configuracion es una clase estática, no tiene sentido crearnos un objeto de dicha clase. En su lugar, podemos hacer lo siguiente:
Configuracion::setColor("blue");
Configuracion::setEntorno("localhost");
Configuracion::setNewsletter(true);

// Al ser las propiedades estáticas, hay que acceder a ellas con Clase::$propiedad (Configuracion::$color, Configuracion::$entorno, etc). 
// Si intentamos acceder como siempre (Configuracion->color, Configuracion->entorno) nos dará error
echo Configuracion::$color . "<br />";
echo Configuracion::$entorno . "<br />";
echo Configuracion::$newsletter . "<br />";




// Clase de ejemplo para ver que para acceder a una propiedad constante es necesario usar también los dobles puntos (::) 
class EjemploConstante{
    // Ejemplo de constante
    const URL_COMPLETA = "http://www.marca.com";
}

// Si queremos acceder a una propiedad constante de un objeto, podemos instanciarlo primero y luego llamarlo con los dobles puntos :: (pero sin el símbolo del dolar) o bien hacerlo
// directamente sin necesidad de crear un objeto como hacíamos en las clases estáticas

/* OPCIÓN 1: INSTANCIANDO UN OBJETO DE LA CLASE */
$ejemplo = new EjemploConstante();
echo $ejemplo::URL_COMPLETA . "<br />";

/* OPCIÓN 2: LLAMANDO DIRECTAMENTE A LA PROPIEDAD */
echo EjemploConstante::URL_COMPLETA;