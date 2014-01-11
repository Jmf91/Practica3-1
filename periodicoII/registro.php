<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" type = "text/css" href = "css/estilo.css" />
<script type="text/javascript" src="js/registro.js"></script>
<title>Periodico Deportivo</title>
</head>
<body onLoad="document.registrar.nombre.focus()">
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
    	<a href="index.html">Periodico Deportivo</a>
    </div>
    <div id="Secciones">
    <table><tr><td><a href="futbol.php" class="futbol"></a></td><td><a href="tennis.php" class="tennis"></a></td><td><a href="NBA.php" class="NBA"></a></td><td><a href="F1.php" class="F1"></a></td><td><a href="ciclismo.php" class="ciclismo"></a></td><td><a href="natacion.php" class="natacion"></a></td></tr></table>
    </div>
    <div class="formulario">
    <fieldset>
	<legend> Formulario para Registrarse a la web del Peridico Deportivo</legend> 
    <?php
		require_once "configuracion.inc";
		$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
		
		$nombre = $_POST[nombre];
		$apellido = $_POST[apellido];
		$DNI = $_POST[DNI];
		$email = $_POST[email];
		$telefono = $_POST[telefono];
		$dia = $_POST[dia];
		$mes = $_POST[mes];
		$anio = $_POST[anio];
		$usuario = $_POST[usuario];
		$contrasenia = $_POST[contrasenia];
		$Futbol = $_POST[Futbol];
		$NBA = $_POST[NBA];
		$Tennis = $_POST[Tennis];
		$F1 = $_POST[F1];
		$Ciclismo = $_POST[Ciclismo];
		$Natacion = $_POST[Natacion]; 
		$conocer = $_POST[conocer];
		$fecha = $anio.'-'.$mes.'-'.$dia;
		
		$usuarioValido = true;
		$correoValido = true;
		$dniValido = true;
		
		echo '<center>';
		$consultaSQL = "SELECT * FROM usuarios where usuario='".$usuario."'";
		$resultados = $conexion->query($consultaSQL);
		foreach ($resultados as $fila ) {
			echo "<H3>El usuario ".$usuario." ya existe</H3>";		
			$usuarioValido = false;
		}
		if($usuario == ''){
			echo "<H3>Debe rellenar el formulario antes de acceder a esta página</H3>";		
			$usuarioValido = false;	
		}
		
		if($usuarioValido){
			$consultaSQL = "SELECT * FROM usuarios where email='".$email."'";
			$resultados = $conexion->query($consultaSQL);
			foreach ($resultados as $fila ) {
				echo "<H3>El correo electronico ".$email." ya esta en uso</H3>";		
				$correoValido = false;
			}	
		}
		if($usuarioValido && $correoValido){
			$consultaSQL = "SELECT * FROM usuarios where DNI='".$DNI."'";
			$resultados = $conexion->query($consultaSQL);
			foreach ($resultados as $fila ) {
				echo "<H3>El DNI ".$DNI." ya se encuentra registrado en la base de datos</H3>";		
				$dniValido = false;
			}	
		}
		
		if($usuarioValido && $correoValido && $dniValido){
			$insertarSQL = "INSERT INTO  usuarios (usuario ,nombre, apellidos , DNI , email , telefono , fecha_nacimiento , password , como_conocer)VALUES ('".$usuario."', '".$nombre."', '".$apellido."', '".$DNI."', '".$email."', '".$telefono."', '".$fecha."', '".$contrasenia."', '".$conocer."')";
			if($conexion->query($insertarSQL)){
				echo '<h3>El usuario ha sido registrado con exito</h3>';
				if($Futbol=='Futbol'){
					$actualizarSQL = "UPDATE usuarios SET futbol = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
				if($NBA=='NBA'){
					$actualizarSQL = "UPDATE usuarios SET NBA = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
				if($Tennis=='Tennis'){
					$actualizarSQL = "UPDATE usuarios SET tennis = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
				if($F1=='F1'){
					$actualizarSQL = "UPDATE usuarios SET f1 = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
				if($Ciclismo=='Ciclismo'){
					$actualizarSQL = "UPDATE usuarios SET ciclismo = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
				if($Natacion=='Natacion'){
					$actualizarSQL = "UPDATE usuarios SET natacion = '1' WHERE usuario = '".$usuario."'";
					$conexion->query($actualizarSQL);
				}
			}
			else{
				echo '<h3>Error al registrar al usuario en la base de datos</h3>
				<form action="suscribirse.html">
				<input type="submit" width="400px" id="boton_volver" name="enviar" value="Volver al Formulario" />	
				</form>';	
			}
		}
		else{
			echo '<form action="suscribirse.html">
			<input type="submit" width="400px" id="boton_volver" name="enviar" value="Volver al Formulario" />	
			</form>';
		}
		echo '</center>';
	?>
    
	</fieldset>
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