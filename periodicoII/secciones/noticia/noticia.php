<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" type = "text/css" href = "../css/estilo.css" />
<title>Periodico Deportivo</title>
<script type="text/javascript" src="../../js/cookies.js"></script>
<script type="text/javascript" src="../../js/comentario.js"></script>
</head>
<body>
<div id="paneluser">
	<script>
	if(GetCookie("quienEstaConectado") != null){
		document.write("<table align=\"right\"><tr><td>Bienvenido de nuevo " + GetCookie('quienEstaConectado') + ".</td>")
		if(GetCookie('quienEstaConectado')=='root'){
			document.write("<td><form action=\"../../admin/registroNoticia.php\"><input type=\"submit\" value=\"Añadir Noticia\"></form></td><td><form action=\"../../admin/editarNoticia.php\"><input type=\"submit\" value=\"Editar Noticia\"></form></td><td><form action=\"../../admin/borrarNoticia.php\"><input type=\"submit\" value=\"Eliminar Noticia\"></form></td><td><form><INPUT TYPE = \"button\" VALUE = \"Cerrar Sesion\" onClick = \"cerrar_sesion()\"></form></td></tr></table>");
		}
		else{
			document.write("</tr></table>");
		}
	}
	else {
		document.write("<FORM action='noticia.php?id=1' method='post'><label for='usuario'>Usuario:</label><input type='text' id='usuario' placeholder='Nombre de usuario' name='usuario' /><label for='password'>Contraseña:</label><input type='password' id='password' placeholder='Password del usuario' name='password' /><input type='submit' value='Acceder'></FORM>");
   }
</script>
<?php
	$usuario = $_POST[usuario];
	$pass = $_POST[password];
	$encontrado = 0;
	$log = 0;
	if($usuario!=''){
		require_once "../../configuracion.inc";
		$conexion1 = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
		$consultaSQL1 = "SELECT * FROM usuarios";
		$resultados1 = $conexion1->query($consultaSQL1);
		foreach ($resultados1 as $fila ) {
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
	<img src="../../banner/Izquierda.png">
</div>

<div id="centro">
    <center>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="bannerTOP" codebase=	"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10.0.0.0">
    <param name="movie" value="banner/Superior.swf" />
    <param name="quality" value="high" />
    <embed src="../../banner/Superior.swf" quality="high" type="application/x-shockwave-flash" width="980" height="90" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
	</object>
    
    <div id=NombrePeriodico>
    	<a href="../../index.php">Periodico Deportivo</a>
    </div>
    <div id="Secciones">
    <table><tr><td><a href="../../futbol.php" class="futbol"></a></td><td><a href="../../tennis.php" class="tennis"></a></td><td><a href="../../NBA.php" class="NBA"></a></td><td><a href="../../F1.php" class="F1"></a></td><td><a href="../../ciclismo.php" class="ciclismo"></a></td><td><a href="../../natacion.php" class="natacion"></a></td></tr></table>
    </div>
    <?php
	require_once "../../configuracion.inc";
	$conexion = new PDO( DB_DSN, DB_USUARIO, DB_CONTRASENIA );
	$id=$_GET['id'];	
	$consultaSQL = "SELECT * FROM noticias where id=".$id;
	$resultados = $conexion->query($consultaSQL);
	foreach ($resultados as $fila ) {
		echo "<div id='NombreSeccion'>";
		if($fila['secciones']=='Futbol'){
    		echo"<img src='../../img/iconos/futbol.png'>
    		Futbol";
		}
		if($fila['secciones']=='NBA'){
    		echo"<img src='../../img/iconos/baloncesto.png'>
    		NBA";
		}
		if($fila['secciones']=='Tennis'){
    		echo"<img src='../../img/iconos/tenNis.png'>
    		Tennis";
		}
		if($fila['secciones']=='F1'){
    		echo"<img src='../../img/iconos/f1.png'>
    		Formula 1";
		}
		if($fila['secciones']=='Natacion'){
    		echo"<img src='../../img/iconos/natacion.png'>
    		Natación";
		}
		if($fila['secciones']=='Ciclismo'){
    		echo"<img src='../../img/iconos/ciclismo.png'>
    		Ciclismo";
		}
    	echo"</div>
    	<div>
    	<div id='NoticiaPrincipal'>
        <section class='Noticia'>";
		echo "<titulo>".utf8_decode($fila['titular'])."</titulo><br><br>
		<subtitulo>".utf8_decode($fila['subtitular'])."</subtitulo><br>
		<img id='foto_noticia' align='right' hspace='10px' src='../../".$fila['foto']."'
		<articulo>".utf8_decode($fila['cuerpo'])."</articulo>
		</section>";
		$comentariosSQL = "SELECT * FROM comentarios where noticia=".$id." order by id DESC";
		$comentarios = $conexion->query($comentariosSQL);
		foreach ($comentarios as $comentario ) {
			echo "<table id='tablacomentarios'>";
			echo "<tr><td class='nombre'>".$comentario[usuario]."</td><td></td><td class='fecha'>".$comentario[dia]." | ".$comentario[hora]."</td></tr>";
			echo "<tr><td></td><td class='texto'>".$comentario[texto]."</td><td></td></tr>";
     		echo "</table>";
		}
		echo "<fieldset class='agregarComentario'><legend>Agregar comentario</legend><form action='noticia.php?id=".$id."' method='post' name='registrocomentario' onSubmit='return validar(this)'>
        <textarea name='Comentarios' onkeyDown='validarComentario()' cols='70' rows='3' placeholder='Tu opinión nos es de gran ayuda. Gracias.'></textarea><br><input type='submit' id='boton' name='InsertarComentario' value='Insertar Comentario' /><br><input type='text' id='numeroLetras' class='mensaje_bueno' style='visibility:hidden'  value= '480' /><input type='hidden' name='usuario_comentario'></form></fieldset>
    </div>
    <div id='NoticiasDerecha'>
    	<section class='RelacionadasNoticia'>
        	<titulo><u>NOTICIAS RELACIONADAS</u></titulo>
            <lista>
        	
            <div style='overflow-y:visible; overflow-x:hidden;height:150px;width:100%;'>
            <ul>";
		$seccion = $fila['secciones'];
		$consulta2SQL = "SELECT * FROM noticias where secciones='".$seccion."' order by id DESC";
		$resultados2 = $conexion->query($consulta2SQL);
		$numerolista = 0;
		foreach ($resultados2 as $fila2 ) {
			if($fila2['id']!=$id && $numerolista<7){
				if($seccion=='Futbol'){
    				echo "<li class='fut_ico'>";
				}
				if($seccion=='NBA'){
    				echo "<li class='nba_ico'>";
				}
				if($seccion=='Tennis'){
    				echo "<li class='ten_ico'>";
				}
				if($seccion=='F1'){
    				echo "<li class='f1_ico'>";
				}
				if($seccion=='Natacion'){
    				echo "<li class='nat_ico'>";
				}
				if($seccion=='Ciclismo'){
    				echo "<li class='cic_ico'>";
				}
				
				echo "<a href='noticia.php?id=".$fila2['id']."'>".$fila2['titular']."</a></li>";
				$numerolista ++;
			}
		}
	}
	?>
    <?php
		if($_POST[Comentarios]!=''){
			$dia = date('d/m/Y');
			$hora = date('H:i');
			$_POST[usuario_comentario];
			$insertarComentarioSQL = "INSERT INTO comentarios (id , noticia , hora , dia , usuario , texto)VALUES ('',".$_GET[id].",'".$hora."','".$dia."','".$_POST[usuario_comentario]."','".$_POST[Comentarios]."')";
			if($conexion->query($insertarComentarioSQL)){
				echo "<script>alert('El comentario fue insertado correctamente. Refresca la pagina para ver su comentario');</script>";
			}
			else{
				echo "<script>alert('Hubo un error al insertar el comentario. Intentelo de nuevo');</script>";	
			}
		}
	?>
            </ul>
            </div>
			
            </lista>
        </section>
        <section class="Publicidad">
        	<a href="http://www.bet365.com"><img src="../../banner/publicidad1.gif" width="300px" vspace="5px" align="center"></a>
         	<a href="http://www.movistar.es"><img src="../../banner/publicidad2.jpg" width="300px" vspace="5px" align="center"></a>
            <a href="http://www.spannabisur.comx"><img src="../../banner/publicidad4.gif" width="300px" vspace="5px" align="center"></a>
        </section>   
    </div>
    </div>
    <script>
   var navegador = navigator.userAgent;
   if (navigator.userAgent.indexOf('Chrome') !=-1) {
    	document.write("<table class='footer'><caption><u>CONTACTO E INFORMACIÓN DEL PERIODICO</u></caption><tr><td><table><tr><th align='right'>Nombre: </th><td align='left'>Francisco Valverde Villalba</td><th align='right'>Dirección:</th><td align='left'>C/Necora nº7, Granada</td></tr><tr><th align='right'>Correo: </th><td align='left'>franvalverde@correo.ugr.es</td><th align='right'>Teléfono: </th><td align='left'>620361126</td></tr><tr><th align='right'>Ultima actualización:</th><td align='left'>30 de Abril de 2013</td><th align='right'>Versión: </th><td align='left'>1.0.1</td></tr></table>");
   }
</script>

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
			xmlhttp.open("GET","../../xml/contacto.xml",false);
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
		<input type='button' value='Suscribirse' onclick='abrir("../../suscribirse.html","_self");return false' /> 
		<input type='button' value='Como se hizo' onclick='abrir("../../como_se_hizo.pdf","_blank");return false' />
		</form>
	</td>
  	</tr>
	</table>
	
</center>
</div>
<div id="derecha">
	<img src="../../banner/Derecha.png">
</div>
</body>
</html>
