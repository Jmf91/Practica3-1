var mostrado = 0;  
var prenoticia = 0;
var numletras = 220;
function validarPreNoticia(){
	if(document.registronoticia.prenoticia.value.length>prenoticia){
		prenoticia++;
		numletras = 220 - document.registronoticia.prenoticia.value.length;
		document.registronoticia.numeroLetras.value = numletras;
		
    }
	if(document.registronoticia.prenoticia.value.length<prenoticia){
		prenoticia--;	
		numletras = 220 + document.registronoticia.prenoticia.value.length;
		document.registronoticia.numeroLetras.value = numletras;
	}
	document.registronoticia.numeroLetras.style.visibility = 'visible';	
	
	if(numletras<0){
		document.registronoticia.prenoticia.focus();
		document.registronoticia.prenoticia.className='con_errores';	
	}
	else{
		document.registronoticia.prenoticia.className='sin_comprobar';		
	}
}

function validar(form){
   var valido = 0;
   if (document.registronoticia.titular.value.length < 1) {
  	 if(valido == 0){
   		document.registronoticia.titular.focus();
   		valido = 1;
   	 }
   }
   if (document.registronoticia.subtitular.value.length < 1) {
  	 if(valido == 0){
   		document.registronoticia.subtitular.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registronoticia.prenoticia.value.length < 1) {
  	 if(valido == 0){
   		document.registronoticia.prenoticia.value.focus();
   		valido = 1;
   	 }
   }
   
   if(valido==1) 
	 return(false);  
}

function seleccionarNoticia(form){
	var valido = 0;
	for ( var i = 0; i < document.seleccionar.id.length; i++ ){
		if ( document.seleccionar.id[i].checked ){
			valido = 1;
		}
	}
	if(valido == 0){
       	alert('Selecciona una noticia a editar.');
		return(false);
	}
	else{	
	}
}