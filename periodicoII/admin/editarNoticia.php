<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" type = "text/css" href = "../css/estilo.css" />
<script type="text/javascript" src="../js/registro_noticia.js"></script>
<script type="text/javascript" src="../js/cookies.js"></script>
<title>Periodico Deportivo</title>
</head>
<body>
<div id="paneluser">
	<script>
	if(GetCookie("quienEstaConectado") != null){
		document.write("<table align=\"right\"><tr><td>Bienvenido de nuevo " + GetCookie('quienEstaConectado') + ".</td>")
		if(GetCookie('quienEstaConectado')=='root'){
			document.write("<td><form action=\"registroNoticia.php\"><input type=\"submit\" value=\"Añadir Noticia\"></form></td><td><form action=\"editarNoticia.php\"><input type=\"submit\" value=\"Editar Noticia\"></form></td><td><form action=\"borrarNoticia.php\"><input type=\"submit\" value=\"Eliminar Noticia\"></form></td><td><form><INPUT TYPE = \"button\" VALUE = \"Cerrar Sesion\" onClick = \"cerrar_sesion()\"></form></td></tr></table>");
		}
		else{
			document.write("<td><form><INPUT TYPE = \"button\" VALUE = \"Cerrar Sesion\" onClick = \"cerrar_sesion()\"></form></td></tr></table>");
		}
	}
</script>
</div>

<div id="izquierda">
	<img src="../banner/Izquierda.png">
</div>

<div id="centro">
    <center>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="bannerTOP" codebase=	"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0">
    <param name="movie" value="../banner/Superior.swf" />
    <param name="quality" value="high" />
    <embed src="../banner/Superior.swf" quality="high" type="application/x-shockwave-flash" width="980" height="90" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
	</object>
    
    <div id=NombrePeriodico>
    	<a href="../index.php">Periodico Deportivo</a>
    </div>
    <div id="Secciones">
    <table><tr><td><a href="../futbol.php" class="futbol"></a></td><td><a href="../tennis.php" class="tennis"></a></td><td><a href="../NBA.php" class="NBA"></a></td><td><a href="../F1.php" class="F1"></a></td><td><a href="../ciclismo.php" class="ciclismo"></a></td><td><a href="../natacion.php" class="natacion"></a></td></tr></table>
    </div>
   
    <div class="formulario">
     <script>
	if(GetCookie("quienEstaConectado") != null){
		document.write("<h1>EDITAR NOTICIA</h1>")
		document.write("<fieldset><legend>Filtrar Noticias</legend>")
		document.write("<form action='editarNoticia.php' method='post'>")
    	document.write("<select id='secciones' name='secciones'>")
			document.write("<option value='Futbol'>Futbol</option>")
			document.write("<option value='NBA'>NBA</option>")
			document.write("<option value='Tennis'>Tennis</option>")
			document.write("<option value='Ciclismo'>Ciclismo</option>")
			document.write("<option value='F1'>Formula1</option>")
			document.write("<option value='Natacion'>Natacion</option>")
        document.write("</select>")
        document.write("<input type='submit' id='boton' name='Filtrar' value='Filtrar'>")
        document.write("</form>")
	}
	else {
		document.write("<h2>ACCESO RESTRINGIDO.</h2><h3>Se necesita tener privilegios de superusuario para poder editar una noticia.</h3>")
   }
</script>
    
    <?php
	$secciones = $_POST[secciones];
	if($secciones!=''){
		echo "<center><h3>Noticias Relacionadas con ".$secciones." </h3>";
		require_once "../configuracion.inc";
		$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
		$consultaSQL = "SELECT * FROM noticias where secciones='".$secciones."'";
		echo "<form name='seleccionar' onSubmit='return seleccionarNoticia(this)' action='editarNoticia2.php' method='post'><table>";
		$resultados = $conexion->query($consultaSQL);
		foreach ($resultados as $fila ) {
			echo "<tr><td><input type='radio' id='id' name='id' value='".$fila['id']."' /></td><td>".utf8_decode($fila['titular'])."</td></tr>";
		}
		echo "</table><input type='submit' id='boton' name='Filtrar' value='Editar'>";
		echo "</center></form>";	
	}
	?>
    
	</fieldset>
    </div>
  
<script type="text/javascript"> 
function abrir(pagina,ventana) 
{ 
var ancho=screen.availWidth; // Ancho de la ventana, en este caso maximizada 
var alto=screen.availHeight; // Alto de la ventana, en este caso maximizada 

// Funci&oacute;n que abre la p&aacute;gina -en la variable pagina- en la ventana elegida en la variable ventana 
// As&iacute; mismo le damos las propiedades deseadas 
window.open(pagina,ventana,'height=alto,width=ancho, hotkeys=yes,location=yes,menubar=yes,personalbar=yes,resizable=yes, scrollbars=yes,status=yes,toolbar=yes,dependent=yes,directories=yes'); 
} 
</script> 

    <script>    
			if (window.XMLHttpRequest){ //codigo para IE7+, Firefox, Chrome, Opera, Safari
  				xmlhttp=new XMLHttpRequest();
  			}
			else{// codigo para IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
			xmlhttp.open("GET","../xml/contacto.xml",false);
			xmlhttp.send();
			xmlDoc=xmlhttp.responseXML; 
			var x=xmlDoc.getElementsByTagName("contacto");
			document.write("<table class='footer'><caption><u>CONTACTO E INFORMACIÓN DEL PERIODICO</u></caption><tr><td><table><tr><th align='right'>Nombre: </th><td align='left'>");
           	document.write(x[0].getElementsByTagName("nombre")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Direcci&oacute;n:</th><td align='left'>");
           	document.write(x[0].getElementsByTagName("direccion")[0].childNodes[0].nodeValue);
			document.write("</td></tr>");
			document.write("<tr><th align='right'>Correo: </th><td align='left'>");
			document.write(x[0].getElementsByTagName("correo")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Tel&eacute;fono: </th><td align='left'>");
			document.write(x[0].getElementsByTagName("telefono")[0].childNodes[0].nodeValue);
			document.write("</td></tr><tr><th align='right'>Ultima actualizaci&oacute;n:</th><td align='left'>");
			document.write(x[0].getElementsByTagName("actualizacion")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Versi&oacute;n: </th><td align='left'>");
			document.write(x[0].getElementsByTagName("version")[0].childNodes[0].nodeValue);
			document.write("</td></tr></table>");
		</script> 
    </td>
    <td><form action='#' method='post' enctype='text/plain'> 
		<input type='button' value='Suscribirse' onclick='abrir("suscribirse.html","_self");return false' /> 
		<input type='button' value='Como se hizo' onclick='abrir("como_se_hizo.pdf","_blank");return false' />
		</form>
	</td>
  	</tr>
	</table>
    
	
</center>
</div>
<div id="derecha">
	<img src="../banner/Derecha.png">
</div>
</body>
</html>


