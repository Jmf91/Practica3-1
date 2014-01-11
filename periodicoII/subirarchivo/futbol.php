<!DOCTYPE HTML>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Periodico Deportivo</title>

<?php
function upload_image($destination_dir,$name_media_field){
        $tmp_name = $_FILES[$name_media_field]['tmp_name'];
        //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
        if ( is_dir($destination_dir) && is_uploaded_file($tmp_name)) 
        {        
            $img_file  = $_FILES[$name_media_field]['name'] ;                      
            $img_type  = $_FILES[$name_media_field]['type'];   
            echo 1; 
            //¿es una imágen realmente?           
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type,"jpg")) || strpos($img_type,"png") )){
                //¿Tenemos permisos para subir la imágen?
                echo 2;
                if(move_uploaded_file($tmp_name, $destination_dir.'/'.$img_file)){                
                    return true;
                }
            }
        }
        //si llegamos hasta aquí es que algo ha fallado
        return false; 
    }
?>

</head>
<body>




<form id="form1" enctype="multipart/form-data" method="post">
      <label>Imagen
        <input id="uploadImage" name="uploadImage" type="file" />
      </label>
    <input id="enviar" name="enviar" type="submit" value="Enviar" />
</form> 

<?php
$seccion = 'futbol';
if(!empty($_POST)){
		if($seccion == 'futbol'){
      		$destino = '../img/secciones/Futbol/';
			var_dump(upload_image($destino,'uploadImage'));
		
	}
	
}
?>


</body>
</html>
