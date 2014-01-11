var mostrado = 0;  
var Comentarios = 0;
var numletras = 480;

function validarComentario(){
	if(document.registrocomentario.Comentarios.value.length>Comentarios){
		Comentarios++;
		numletras = 480 - document.registrocomentario.Comentarios.value.length;
		document.registrocomentario.numeroLetras.value = numletras;
		
    }
	if(document.registrocomentario.Comentarios.value.length<Comentarios){
		Comentarios--;	
		numletras = 480 + document.registrocomentario.Comentarios.value.length;
		document.registrocomentario.numeroLetras.value = numletras;
	}
	document.registrocomentario.numeroLetras.style.visibility = 'visible';	
	
	if(numletras<0){
		document.registrocomentario.Comentarios.focus();
		document.registrocomentario.numeroLetras.className='mensaje_error';	
	}
	else{	
		document.registrocomentario.numeroLetras.className='mensaje_bueno';	
	}
}

function validar(form){
   var valido = 0;
   if(GetCookie("quienEstaConectado") == null){
	 if(valido == 0){
	 	alert('Debe estar logueado para insertar un comentario');
		valido = 1;
   	 } 
   }
   if (document.registrocomentario.numeroLetras.className!='mensaje_bueno') {
  	 if(valido == 0){
	 	alert('El numero de caracteres permitidos por comentario ha sido revasado');
		valido = 1;
   	}
   }
   if(valido==1) 
	 	return(false);  
   document.registrocomentario.usuario_comentario.value=GetCookie("quienEstaConectado");
   /*else{
	    var usuario
		window.location.href="index.php?cnt1="+cnt1+"&time="+tim;   
   }*/
}
