<html>
<head>
<title>Codigo La Web del Programador - http://www.lawebdelprogramador.com</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<style type="text/css">
    /* Estilo que muestra la capa flotante */
    #flotante
    {
        position: absolute;
        display:none;
        font-family:Arial;
        font-size:0.8em;
        width:280px;
        border:1px solid #808080;
        background-color:#f1f1f1;
        padding:5px;
    }
    
    .text {font-weight:bold;}
</style>

<script type='text/javascript'>
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
        setTimeout('$("#flotante").hide();',3000)
		
    });
});
</script>
</head>
<body>

<!-- En este div se muestra la capa emergente -->
<div id="flotante"></div>

<p>
<?php
	echo "<div class='text' content='Este codigo se ha probado con:<ul><li>IE6, 7, 8 y 9</li><li>Firefox</li><li>Chrome</li><li>Safari</li><li>Opera</li></ul>'>Información</div>";
?>

<div class='text' content="Texto descritivo para la primera linea de texto" style='margin-top:30px;'>Por el raton encima para ver la capa</div>
<div class='text' content="Este texto aparece en el segundotexto de la pantalla" style='margin-top:30px;'>Por el raton encima para ver la capa</div>
</p>

<p style='clear:both;text-align:center'><a href="http://www.lawebdelprogramador.com">http://www.lawebdelprogramador.com</a></p>

<div>
<div class='text' content="Este texto aparece en el segundotexto de la pantalla" style='margin-top:30px;'>Por el raton encima para ver la capa</div>
</div>
</body>
</html>