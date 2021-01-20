<?php

// Una clase estática es aquella que vamos a utilizar sin instanciar ningún objeto de ella. Para usarla no es necesario crear ningún objeto
class Configuracion{
    // Cuando tenemos una clase estática, todos los atributos y métodos deben llevar el atributo static
    public static $color;
    public static $newsletter;
    public static $entorno;
    
    // Cuando queremos acceder a propiedades/métodos estáticoss, debemos usar el self:: (sería el equivalente a $this cuando una propiedad/método no es estático)
    public static function getColor() {
        return self::$color;
    }

    public static function getNewsletter() {
        return self::$newsletter;
    }

    public static function getEntorno() {
        return self::$entorno;
    }

    public static function setColor($color) {
        self::$color = $color;
    }

    public static function setNewsletter($newsletter) {
        self::$newsletter = $newsletter;
    }

    public static function setEntorno($entorno) {
        self::$entorno = $entorno;
    }


}