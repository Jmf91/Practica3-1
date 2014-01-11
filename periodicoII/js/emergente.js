$(document).ready(function(){
    // Cuando el mouse se pone encima de un elemento con el class=text
    $(".text").mouseenter(function(event){
        // Ponemos en el div flotante el contenido del attributo content del div
        // donde se encuentra el mouse (this)
        $("#flotante").html($(this).attr("content"));
        // Posicionamos el div flotante y mo lostramos
        $("#flotante").css({left:event.pageX+5, top:event.pageY+5, display:"block"});
    });
    
    // Cuando el mouse sale del elemento con el class=text
    $(".text").mouseleave(function(event){
        // Escondemos el div flotante
		setTimeout('$("#flotante").hide();',10000)
	        
    });
});