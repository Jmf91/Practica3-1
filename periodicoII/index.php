<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" type = "text/css" href = "css/estilo.css" />
<title>Periodico Deportivo</title>
<script type="text/javascript" src="js/cookies.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="js/emergente.js"></script>
</head>
<body>
<div id="paneluser">
	<script>
	if(GetCookie("quienEstaConectado") != null){
		document.write("<table align=\"right\"><tr><td>Bienvenido de nuevo " + GetCookie('quienEstaConectado') + ".</td>")
		if(GetCookie('quienEstaConectado')=='root'){
			document.write("<td><form action=\"admin/registroNoticia.php\"><input type=\"submit\" value=\"Añadir Noticia\"></form></td><td><form action=\"admin/editarNoticia.php\"><input type=\"submit\" value=\"Editar Noticia\"></form></td><td><form action=\"admin/borrarNoticia.php\"><input type=\"submit\" value=\"Eliminar Noticia\"></form></td><td><form><INPUT TYPE = \"button\" VALUE = \"Cerrar Sesion\" onClick = \"cerrar_sesion()\"></form></td></tr></table>");
		}
		else{
			document.write("<td><form><INPUT TYPE = \"button\" VALUE = \"Cerrar Sesion\" onClick = \"cerrar_sesion()\"></form></td></tr></table>");
		}
	}
	else {
		document.write("<FORM action='index.php' method='post'><label for='usuario'>Usuario:</label><input type='text' id='usuario' placeholder='Nombre de usuario' name='usuario' /><label for='password'>Contraseña:</label><input type='password' id='password' placeholder='Password del usuario' name='password' /><input type='submit' value='Acceder'></FORM>");
   }
</script>
<?php
	$usuario = $_POST[usuario];
	$pass = $_POST[password];
	$encontrado = 0;
	$log = 0;
	if($usuario!=''){
		require_once "configuracion.inc";
		$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
		$consultaSQL = "SELECT * FROM usuarios";
		$resultados = $conexion->query($consultaSQL);
		foreach ($resultados as $fila ) {
			if($usuario==$fila["usuario"]){
				if($pass==$fila["password"]){
					echo "<script>alert('Usuario logueado correctamente')</script>";
					echo "<script>setTimeout(guardar_cookie('".$usuario."'),10)</script>";
				}
				else{
					echo "<script>alert('Contraseña incorrecta');</script>";	
				}
				$encontrado = 1;
			}
		}
		if($encontrado == 0){
			echo "<script>alert('El usuario no existe');</script>";	
		}
	}
?>
  
</div>
<div id="izquierda">
	<img src="banner/Izquierda.png">
</div>

<div id="centro">
    <center>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="bannerTOP" codebase=	"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0">
    <param name="movie" value="banner/Superior.swf" />
    <param name="quality" value="high" />
    <embed src="banner/Superior.swf" quality="high" type="application/x-shockwave-flash" width="980" height="90" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
	</object>
    
    <div id=NombrePeriodico>
    	Periodico Deportivo
    </div>
    <div id="Secciones">
    <table><tr><td><a href="futbol.php" class="futbol"></a></td><td><a href="tennis.php" class="tennis"></a></td><td><a href="NBA.php" class="NBA"></a></td><td><a href="F1.php" class="F1"></a></td><td><a href="ciclismo.php" class="ciclismo"></a></td><td><a href="natacion.php" class="natacion"></a></td></tr></table>
    </div>
    <div>
    <div id="NoticiasIzquierda"> <div id="flotante"></div>
    <?php
    require_once "configuracion.inc";
	$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
    $consultaSQL = "SELECT * FROM noticias where Portada=1 order by id DESC";
	$resultados = $conexion->query($consultaSQL);
	$numNoticia=0;
	foreach ($resultados as $fila ) {
		  $consulta1SQL = "SELECT * FROM noticias";
		  $res1 = $conexion->query($consulta1SQL);
		  $cad = "<ul>";
		  $contadorVentana = 0;
		  foreach ($res1 as $fil ) {
			  if($fil['secciones']==$fila['secciones'] && $contadorVentana<4 && $fil['id']!=$fila['id']){
			 	$contadorVentana = $contadorVentana + 1;
				//$cadenaVentana = "<a href='secciones/noticia/noticia.php?id=".$fil['id']."'>".utf8_decode($fil['titular'])."</a><br>";   
			 	$cadenaVentana = "<li>".utf8_decode($fil['titular'])."</li>";   
			 	$cad = $cad . $cadenaVentana;
			  }
		  }
		  $cad = $cad . "</ul>";
		  if($numNoticia<5){  
			echo "<section class='Noticia'>
			<titulo><div class='text' content='".$cad."' <a href='secciones/noticia/noticia.php?id=".$fila['id']."'>".utf8_decode($fila['titular'])."</a></div></titulo><br>
			<img src='".$fila['foto']."' align='right' width='170px' hspace='10px'>
			<articulo>".utf8_decode($fila['prenoticia'])." </articulo></section>";	
		  }
		  else{ 
		  	if($numNoticia==5){
			 	echo "</div><div id='NoticiasCentro'>";
			}
			if($numNoticia<10){
				echo "<section class='Noticia'>
				<titulo><div class='text' content='".$cad."' <a href='secciones/noticia/noticia.php?id=".$fila['id']."'>".utf8_decode($fila['titular'])."</a></div></titulo><br>
				<img src='".$fila['foto']."' align='right' width='170px' hspace='10px'>
				<articulo>".utf8_decode($fila['prenoticia'])." </articulo></section>";	
			}
		  }
		  $numNoticia++;
	}
	?>
    </div>
    <div id="NoticiasDerecha"> 
    	<section class="UltimaNoticia">
        	<titulo><u>ULTIMAS NOTICIAS</u></titulo>
            <lista>
        	
            <div style="overflow-y:visible; overflow-x:hidden;height:150px;width:100%;">
            <ul>
     <?php
	 	$consulta2SQL = "SELECT * FROM noticias order by id DESC";
		$resultados2 = $conexion->query($consulta2SQL);
		$numerolista = 0;
		foreach ($resultados2 as $fila2 ) {
			if($numerolista<7){
				if($fila2['secciones']=='Futbol'){
    				echo "<li class='fut_ico'>";
				}
				if($fila2['secciones']=='NBA'){
    				echo "<li class='nba_ico'>";
				}
				if($fila2['secciones']=='Tennis'){
    				echo "<li class='ten_ico'>";
				}
				if($fila2['secciones']=='F1'){
    				echo "<li class='f1_ico'>";
				}
				if($fila2['secciones']=='Natacion'){
    				echo "<li class='nat_ico'>";
				}
				if($fila2['secciones']=='Ciclismo'){
    				echo "<li class='cic_ico'>";
				}
				
				echo "<a href='secciones/noticia/noticia.php?id=".$fila2['id']."'>".utf8_decode($fila2['titular'])."</a></li>";
				$numerolista ++;
			}
		}
	 ?>       
            </ul>
            </div>
			
            </lista>
        </section>
        <section class="Publicidad">
        	<a href="http://www.bet365.com"><img src="banner/publicidad1.gif" width="300px" vspace="5px" align="center"></a>
         	<a href="http://www.movistar.es"><img src="banner/publicidad2.jpg" width="300px" vspace="5px" align="center"></a>
            <a href="http://www.heineken.com/AgeGateway.aspx"><img src="banner/publicidad3.jpg" width="300px" vspace="5px" align="center"></a>
        </section>   
    </div>
    </div>
<script type="text/javascript"> 
function abrir(pagina,ventana) 
{ 
var ancho=screen.availWidth; // Ancho de la ventana, en este caso maximizada 
var alto=screen.availHeight; // Alto de la ventana, en este caso maximizada 

// Función que abre la página -en la variable pagina- en la ventana elegida en la variable ventana 
// Así mismo le damos las propiedades deseadas 
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
			xmlhttp.open("GET","xml/contacto.xml",false);
			xmlhttp.send();
			xmlDoc=xmlhttp.responseXML; 
			var x=xmlDoc.getElementsByTagName("contacto");
			document.write("<table class='footer'><caption><u>CONTACTO E INFORMACIÓN DEL PERIODICO</u></caption><tr><td><table><tr><th align='right'>Nombre: </th><td align='left'>");
           	document.write(x[0].getElementsByTagName("nombre")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Dirección:</th><td align='left'>");
           	document.write(x[0].getElementsByTagName("direccion")[0].childNodes[0].nodeValue);
			document.write("</td></tr>");
			document.write("<tr><th align='right'>Correo: </th><td align='left'>");
			document.write(x[0].getElementsByTagName("correo")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Teléfono: </th><td align='left'>");
			document.write(x[0].getElementsByTagName("telefono")[0].childNodes[0].nodeValue);
			document.write("</td></tr><tr><th align='right'>Ultima actualización:</th><td align='left'>");
			document.write(x[0].getElementsByTagName("actualizacion")[0].childNodes[0].nodeValue);
			document.write("</td><th align='right'>Versión: </th><td align='left'>");
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
	<img src="banner/Derecha.png">
</div>
</body>
</html>