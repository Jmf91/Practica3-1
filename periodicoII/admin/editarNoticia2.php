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
     
    
    <?php
	$id = ($_POST[id]);
	if($id == ""){
		echo "<center><h2>ACCESO RESTRINGIDO.</h2><h3>Se necesita tener privilegios de superusuario para poder editar una noticia.</h3></center>";
	}
	else{
		require_once "../configuracion.inc";
		$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
		$consultaSQL = "SELECT * FROM noticias where id='".$id."'";
		$resultados = $conexion->query($consultaSQL);
		foreach ($resultados as $fila ) {
			echo "<fieldset><legend> Formulario para agregar una nueva noticia</legend>
    		<form action='editarNoticia2.php' method='post' name='registronoticia' onSubmit='return validar(this)' enctype='multipart/form-data'>
			<input type=text' name='id' id='id' value='".$fila[id]."' style='visibility:hidden'>    		
			<table><tr><td><label for='titular'>Titular:</label></td>
       		<td><input type='text' width='600px' name='titular' id='titular' class='sincomprobar_noticia' value='".utf8_decode($fila[titular])."'</td></tr>
       		<tr><td><label for='subtitular'>Subtitular:</label></td><td>
       		<input type='text' name='subtitular' id='subtitular' class='sincomprobar_noticia'  value='".utf8_decode($fila[subtitular])."'</td></tr>
       		<tr><td><label for='cuerpo'>Cuerpo:</label></td><td>
       		<textarea name='cuerpo' id='cuerpo' class='sincomprobar' cols='90' rows='7'>".utf8_decode($fila[cuerpo])."</textarea></td></tr>
       		<tr><td><label for='imagen'>Imagen de la noticia:</label></td><td>
       		<input name='imagen' id='imagen' type='file'> </td>";
			echo "<td><img width='100px' src='../".$fila[foto]."' </td></tr>";
       		echo "<tr><td><label for='prenoticia'>Descripcion de la noticia:</label></td><td>
       		<textarea name='prenoticia' id='prenoticia' class='sincomprobar' cols='90' rows='3' onkeyDown='validarPreNoticia()'>".utf8_decode($fila[prenoticia])."</textarea><input type='text' id='numeroLetras' class='mensaje_error' style='visibility:hidden'  value= '220' /></td></tr><tr><td><label for='seccion'>Secci&oacute;n de la noticia:</label></td><td>";
			if($fila[secciones]=="Futbol"){
				echo "<input type='radio' id='seccion' name='seccion' checked value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion' name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion' value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
			if($fila[secciones]=="NBA"){
				echo "<input type='radio' id='seccion' name='seccion' value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' checked  name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion' name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion' value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
			if($fila[secciones]=="Tennis"){
				echo "<input type='radio' id='seccion' name='seccion' value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' checked value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion' name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion' value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
			if($fila[secciones]=="F1"){
				echo "<input type='radio' id='seccion' name='seccion' value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion'checked name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion' value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
			if($fila[secciones]=="Ciclismo"){
				echo "<input type='radio' id='seccion' name='seccion' value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion' name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion'  checked   value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
			if($fila[secciones]=="Natacion"){
				echo "<input type='radio' id='seccion' name='seccion' value='Futbol' />Futbol&nbsp;<input type='radio' id='seccion' name='seccion' value='NBA' />NBA&nbsp;<input type='radio' id='seccion' name='seccion' value='Tennis'/>Tennis&nbsp;<input type='radio' id='seccion' name='seccion' value='F1'/>Formula 1&nbsp;<input type='radio' id='seccion' name='seccion' value='Ciclismo'/>Ciclismo&nbsp;<input type='radio' id='seccion' checked  name='seccion' value='Natacion'/>Nataci&oacute;n</td>";
			}
       		echo "</tr><tr><td><label for='portada'>Mostrar en Portada:</label></td><td>";
			if($fila[Portada]==1){
				echo "<input type='radio' name='portada' id='portada' checked value='1'>S&iacute;&nbsp;<input type='radio' name='portada' id='portada' value='0'>No</td></tr>";
			}else{
				echo "<input type='radio' name='portada' id='portada' value='1'>S&iacute;&nbsp;<input type='radio' name='portada' id='portada' checked value='0'>No</td></tr>";
			}
       		echo "</table><center><input type='checkbox' id='confirmar' name='confirmar' value='1'>Confirmar cambios <input type='submit' id='boton' name='Editar Noticia' /></center></form>";
		}
	}
	?>
	</fieldset>
    <?php
		$id = $_POST[id];
		$titular = utf8_encode($_POST[titular]);
		$subtitular = utf8_encode($_POST[subtitular]);
		$cuerpo = utf8_encode($_POST[cuerpo]);
		$prenoticia = utf8_encode($_POST[prenoticia]);
		$seccion = $_POST[seccion];
		$portada = $_POST[portada];
		
		if($_POST[confirmar]==1){
			require_once "../configuracion.inc";
			$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );

			if($seccion=='Futbol'){
				$destino = '../img/secciones/Futbol';
				$destino2 = 'img/secciones/Futbol';		
			}
			if($seccion=='NBA'){
				$destino = '../img/secciones/NBA';
				$destino2 = 'img/secciones/NBA';		
			}
			if($seccion=='Tennis'){
				$destino = '../img/secciones/Tennis';
				$destino2 = 'img/secciones/Tennis';		
			}
			if($seccion=='F1'){
				$destino = '../img/secciones/Formula1';	
				$destino2 = 'img/secciones/Formula1';	
			}
			if($seccion=='Natacion'){
				$destino = '../img/secciones/Natacion';	
				$destino2 = 'img/secciones/Natacion';	
			}
			if($seccion=='Ciclismo'){
				$destino = '../img/secciones/Ciclismo';	
				$destino2 = 'img/secciones/Ciclismo';	
			}
			if($seccion==''){
				$destino = '../img/secciones';
				$destino2 = 'img/secciones';	
			}
			
			if($_FILES[imagen]['name'] != ""){
				$tmp_name = $_FILES[imagen]['tmp_name'];   
        		if ( is_dir($destino) && is_uploaded_file($tmp_name)) {        
            		$img_file  = $_FILES[imagen]['name'] ;                      
            		$img_type  = $_FILES[imagen]['type'];    
            		if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,"jpg")) || strpos($img_type,"png") )){
                		if(move_uploaded_file($tmp_name, $destino.'/'.$img_file)){                
                    		$imagen = $destino2.'/'.$img_file;
							$insertarSQL = "UPDATE noticias SET titular='".$titular."' , subtitular='".$subtitular."' , cuerpo='".$cuerpo."' , foto='".$imagen."' , secciones='".$seccion."' , prenoticia='".$prenoticia."' , Portada='".$portada."' WHERE id=".$id;
							if($conexion->query($insertarSQL)){
								echo "<script>alert('La noticia fue editado correctamente');</script>";
							}
							else{
								echo "<script>alert('Hubo un error al editar la noticia. Intentelo de nuevo');</script>";	
							}
                		}
            		}
					else{
						echo "<script>alert('El formato de la imagen no es el adecuado. Se admite: gif, jpeg, jpg, png');</script>";			
					}
        		}
			}
			else{
				$insertarSQL = "UPDATE noticias SET titular='".$titular."' , subtitular='".$subtitular."' , cuerpo='".$cuerpo."' , secciones='".$seccion."' , prenoticia='".$prenoticia."' , Portada='".$portada."'  WHERE id=".$id;
				if($conexion->query($insertarSQL)){
					echo "<script>alert('La noticia fue insertada correctamente');</script>";
				}
				else{
					echo "<script>alert('Hubo un error al insertar la noticia. Intentelo de nuevo');</script>";	
				}
			}

		}
	?>
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



