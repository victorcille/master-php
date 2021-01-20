<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        {{-- El @yield nos permite declarar un futuro section de nuestro HTML que se definira en las vistas que son heredadas y no puede 
        agregarse algun tipo de contenido por defecto --}}
        <title>Titulo - @yield('titulo')</title>
    </head>
    
    <body>
        {{-- El @section tiene dos usos dependiendo de lo que queramos declarar: 
        el primero es que nos permite declarar como su nombre indica una sección dentro del template que puede tener un contenido por defecto 
        que si no es redefinido en la vista que herede entonces aparecerá; 
        el segundo nos permite asignar el contenido en una seccion que fue declarada en nuestro template, es decir esta palabra section se usa 
        tanto en el template como en las vistas hijas. 
        Una diferencia mas es que si se usa en el template entonces la seccion temina con un @show, pero si se usa en una vista hija entonces 
        termina la seccion con un @stop --}}
        
        @section('header')
            <h1>CABECERA DE LA WEB (master)</h1>
        @show
        
        <div class='container'>
            @yield('content')
        </div>
        
        @section('footer')
            PIE DE PÁGINA DE LA WEB
        @show
        
    </body>
</html>
