var url = 'http://proyecto_instagram.com.devel';

window.addEventListener("load", function(){
    like();
    dislike();
    
    // De dislike a like: Si lo pincho cambiamos su clase de heart (dislike) a heart-like (like)
    function like(){
        // El unbind('click') lo que hace es que no se acumulen los eventos click y que sólo se ejecute 1 evento por click
        // Para ver lo que digo descomentar el console.log y quitar el unbind('click') y ver qué pasa
        $(".heart").unbind('click').click(function(){
            //console.log('like');
            $(this).addClass('heart-like').removeClass('heart');  // Con $(this) estamos seleccionando el elemento al que le estamos haciendo click
            
            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a la publicación');
                    }else{
                        console.log(response.message);
                    }
                    
                }
            });
            
            dislike();
        });
    }
    
    // Hacemos lo mismo para de like a dislike 
    function dislike(){
        $(".heart-like").unbind('click').click(function(){
            //console.log('like');
            $(this).addClass('heart').removeClass('heart-like');
            
            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log(response.message);
                    }else{
                        console.log(response.message);
                    }
                    
                }
            });
            
            like();
        });
    }
    
    // Vamos a añadir a la url de la ruta de 'gente', el texto que hayamos metido en la barra del buscador cuando pulsemos el botón submit
    $("#buscador").submit(function(evento){
        let texto = $('#buscador #search').val();
        $(this).attr('action', url + '/users/' + texto);
    });
});
