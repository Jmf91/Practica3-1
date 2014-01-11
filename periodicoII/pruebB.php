<html> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
        
<link rel = "stylesheet" type = "text/css" href = "css/estilo.css" />
<script type="text/javascript" src="js/emergente.js"></script>
    </head> 
    <body onLoad="ini()" > 
        <div 
            id="ventana" 
            style=" visibility:hidden; 
            position:absolute; 
            background:yellow; 
            font:normal 10px/10px verdana; 
            color:black; 
            border:solid 1px black; 
            text-align:justify; 
            padding:10px 10px 10px 10px;"> 
        </div> 
    
	    <?php $phpvar    = "este es mi contenido en php un string..<br>hola antonio";?>
        <a href="index.php" onMouseOver="mostrar('<?php echo $phpvar?>')" onMouseOut="ocultarenX()">PACCOCOOOO </a>
	
        
        
	</body> 
</html>  
