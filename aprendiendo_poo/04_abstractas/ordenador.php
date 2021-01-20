<?php

// Para definir una clase abstracta basta sólo con poner delante la palabra abstract.
// Las clases abstractas se caracterizan porque NO SE PUEDEN INSTANCIAR. 
// Simplemente pueden tener o no unos atributos y definen una serie de métodos que TIENEN QUE LLEVAR Y DESARROLLAR OBLIGATORIAMENTE los hijos que extiendan de ella.
abstract class Ordenador{
    // Una clase abstracta PUEDE TENER PROPIEDADES O ATRIBUTOS, pero no es recomendable definir aquí ninguna, sino en la clase hija. 
    // Los métodos que definamos como abstractos NO SE DESARROLLAN (los desarrollarán los hijos) sino SIMPLEMENTE SE DEFINEN.
    abstract public function encender();
    abstract public function apagar();
    
    // Este método al no ser abstracto será común para todas las clases que extiendan de esta y por tanto la heredarán y podrá ser invocada (al ser pública)
    public function getPiezas(){
        return "Un ordenador tiene un procesador, una fuente de alimentación, un teclado, un ratón, etc...";
    }
}

