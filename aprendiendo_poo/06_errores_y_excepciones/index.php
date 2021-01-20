<?php

/*
// Con esta sentencia devolvemos un error al cual le podemos pasar como argumento lo que nosotros queramos (un texto, una veriable, etc)
throw new Exception('Hay un error');
*/

// Con el try y el catch capturamos excepciones (errores) en código susceptible de que falle
try{
    // Aquí iría el código que es susceptible de que falle. EJEMPLO
    if(isset($_GET['id'])){
        echo "<h1>El parámetro es: {$_GET['id']}</h1>";
    }else{
        throw new Exception('faltan parámetros por la url');
    }
} catch (Exception $e) {
    echo "Se ha producido el error: {$e->getMessage()}";
}
