var mostrado = 0;  


//validar nombre   
function compruebaNombre(){
  if (document.registrar.nombre.value.length < 3) {
   document.registrar.nombre.focus();
   if(mostrado==0)
    document.registrar.errorNombre.style.visibility = 'visible';
    document.registrar.nombre.className='con_errores'; 
	mostrado = 1;
  }
  else{
	mostrado = 0; 
    document.registrar.nombre.className='comprobado'; 
    document.registrar.errorNombre.style.visibility = 'hidden';
	document.registrar.apellido.focus();
  } 
}


//validar apellidos
function compruebaApellidos(){
  if (document.registrar.apellido.value.length == 0) {
   document.registrar.apellido.focus();
   if(mostrado==0)
    document.registrar.errorApellido.style.visibility = 'visible';
	document.registrar.apellido.className='con_errores';
	mostrado = 1;
  }
  else{
	mostrado = 0;
    document.registrar.errorApellido.style.visibility = 'hidden';
	document.registrar.apellido.className='comprobado';
	document.registrar.DNI.focus();  
  } 
}


//validar DNI
function compruebaDNI() {
  var dni = document.registrar.DNI.value
  var numero
  var let
  var letra
  var expresion_regular_dni
 
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
 
  if(expresion_regular_dni.test (dni) == true){
     numero = dni.substr(0,dni.length-1);
     let = dni.substr(dni.length-1,1);
     numero = numero % 23;
     letra='TRWAGMYFPDXBNJZSQVHLCKET';
     letra=letra.substring(numero,numero+1);
     if (letra!=let){
		if(mostrado == 0) {
       		alert('Dni erroneo, la letra del NIF no se corresponde');
			mostrado = 1;
    	} 
		document.registrar.DNI.focus();
		document.registrar.DNI.className='con_errores';
		document.registrar.errorDNI.style.visibility = 'visible';
	 }else{
        document.registrar.DNI.className='comprobado';
		document.registrar.errorDNI.style.visibility = 'hidden';
		mostrado = 0;
		document.registrar.email.focus();
     }
  }else{
	document.registrar.DNI.focus();
	document.registrar.DNI.className='con_errores';
    document.registrar.errorDNI.style.visibility = 'visible';
  }
}


//validar Email
function compruebaEmail(){
  if (document.registrar.email.value.length == 0) {
   		document.registrar.email.focus();
		if(mostrado == 0){
			alert('El campo Email es obligatorio');	
			mostrado = 1;
		}
	  	document.registrar.email.className='con_errores';
		document.registrar.errorEmail.style.visibility = 'visible';
  }	
  var ultimovalor = document.registrar.email.value.length-1;	
  if ((document.registrar.email.value.indexOf ('@', 0) == -1)||(document.registrar.email.value.length < 5)||(document.registrar.email.value.indexOf ('.', 0) == -1)||(document.registrar.email.value.charAt(0) =='@')||(document.registrar.email.value.charAt(ultimovalor) =='.')||(document.registrar.email.value.charAt(ultimovalor) =='@')) { 
   		document.registrar.email.focus();
		if(mostrado == 0){
			alert('Formato incorrecto para un correo electronico');
			mostrado = 1;
		}
	  	document.registrar.email.className='con_errores';
		document.registrar.errorEmail.style.visibility = 'visible';
	  
  }
  else{
	  document.registrar.email.className='comprobado';	  
  	  document.registrar.errorEmail.style.visibility = 'hidden';
	  document.registrar.telefono.focus();
	  mostrado = 0;  

  }
}

function compruebaTelefono(){
  var numeroOK = "0123456789";
  var tlf = document.registrar.telefono.value;
  if (tlf.charAt(0) == '+') { //11 digitos
   if(tlf.length==12){
   		for (i = 1; i < tlf.length; i++) {  
			for (j = 0; j < numeroOK.length; j++) 
				if (tlf.charAt(i) == numeroOK.charAt(j)) 
					break; 
			if (j == numeroOK.length) { 
				if(mostrado == 0){
					mostrado = 1;
   	   			}
				document.registrar.telefono.focus();
				document.registrar.telefono.className='con_errores';
				document.registrar.errorTelefono.style.visibility = 'visible';		  
				break; 
			} 
		}
		if(mostrado==0){
			document.registrar.telefono.className='comprobado';
			document.registrar.errorTelefono.style.visibility = 'hidden';
		}
		mostrado = 0;
   }
   else{
	if(mostrado == 0){
			mostrado = 1;
   	}
	document.registrar.telefono.focus();
	document.registrar.telefono.className='con_errores';
	document.registrar.errorTelefono.style.visibility = 'visible';
   }
  }
  else{
   if(tlf.length!=9){
	   if(mostrado == 0){
			mostrado = 1;
   	   } 
	   document.registrar.telefono.focus();
	   document.registrar.telefono.className='con_errores';
   	   document.registrar.errorTelefono.style.visibility = 'visible';				
   }
   else{
	  	for (i = 0; i < tlf.length; i++) {  
			for (j = 0; j < numeroOK.length; j++) 
				if (tlf.charAt(i) == numeroOK.charAt(j)) 
					break; 
			if (j == numeroOK.length) { 
				if(mostrado == 0){
					mostrado = 1;
   	   			}
				document.registrar.telefono.focus();
			    document.registrar.telefono.className='con_errores';
			    document.registrar.errorTelefono.style.visibility = 'visible';
   						  
				break; 
			} 
		}
	  
   }
  }
  if(mostrado==0){
  	document.registrar.telefono.className='comprobado';
  	document.registrar.errorTelefono.style.visibility = 'hidden';
  }
  mostrado = 0; 
}

//Comrobar fecha
var mestocado = false;
function compruebaDia(){
	if(mestocado){
		var dia=document.registrar.dia.value;
		var mes=document.registrar.mes.value;
		if(mes==1 || mes==3 || mes==5 || mes==7 || mes==8 || mes==10 || mes==12){
			document.registrar.errorFecha.style.visibility = 'hidden';
		}
		
		if(mes==4 || mes==6 || mes==9 || mes==11){
			if(dia>30){
				document.registrar.errorFecha.style.visibility = 'visible';
			}
			else{
				document.registrar.errorFecha.style.visibility = 'hidden';
			}
		}
		
		if(mes==2){
			if(dia>29){
				document.registrar.errorFecha.style.visibility = 'visible';
			}
			else{
				document.registrar.errorFecha.style.visibility = 'hidden';
			}
		}
			
	}
}

function compruebaMes(){
	mestocado = true;
	var dia=document.registrar.dia.value;
	var mes=document.registrar.mes.value;
	if(mes==1 || mes==3 || mes==5 || mes==7 || mes==8 || mes==10 || mes==12){
		document.registrar.errorFecha.style.visibility = 'hidden';
	}
	if(mes==4 || mes==6 || mes==9 || mes==11){
		if(dia>30){
			document.registrar.errorFecha.style.visibility = 'visible';
		}
		else{
			document.registrar.errorFecha.style.visibility = 'hidden';
		}
	}
	if(mes==2){
		if(dia>29){
			document.registrar.errorFecha.style.visibility = 'visible';
		}
		else{
			document.registrar.errorFecha.style.visibility = 'hidden';
		}
	}
}

function compruebaContrasenia1(){
  if (document.registrar.contrasenia.value.length < 4) {
   document.registrar.contrasenia.focus();
   document.registrar.contrasenia.className='con_errores'; 
   document.registrar.errorContrasenia.style.visibility = 'visible';
  }
  else{
	document.registrar.contrasenia.className='sincomprobar'; 
	document.registrar.repeatcontrasenia.focus();
    document.registrar.errorContrasenia.style.visibility = 'hidden';
  } 
}

function compruebaContrasenia2(){
  if (document.registrar.repeatcontrasenia.value != document.registrar.contrasenia.value) {
   document.registrar.contrasenia.focus();
   document.registrar.contrasenia.className='con_errores';
   document.registrar.repeatcontrasenia.className='con_errores';
   document.registrar.errorContrasenia.style.visibility = 'visible'; 
  }
  else{
	document.registrar.contrasenia.className='comprobado';
	document.registrar.repeatcontrasenia.className='comprobado'; 
    document.registrar.errorContrasenia.style.visibility = 'hidden';
	document.registrar.futbol.focus();
  } 
}

function compruebaConocer(){
  if (document.registrar.conocer.value.length < 2) {
   document.registrar.conocer.focus();
   document.registrar.conocer.className='con_errores'; 
  }
  else{
	document.registrar.conocer.className='comprobado'; 
	document.registrar.enviar.focus();
  } 	
}


function compruebaUsuario(){
  if (document.registrar.usuario.value.length < 4) {
   document.registrar.usuario.focus();
   document.registrar.usuario.className='con_errores';
   document.registrar.errorUsuario.style.visibility = 'visible'; 
  }
  else{
	document.registrar.usuario.className='comprobado'; 
	document.registrar.contrasenia.focus();
    document.registrar.errorUsuario.style.visibility = 'hidden'; 
  }
}


function validar(form){
   var valido = 0;
   if (document.registrar.nombre.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.nombre.focus();
   		valido = 1;
   	 }
   }
   if (document.registrar.apellido.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.apellido.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registrar.DNI.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.DNI.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registrar.email.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.email.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registrar.errorFecha.style.visibility == 'visible') {
  	 if(valido == 0){
   		document.registrar.dia.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registrar.usuario.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.usuario.focus();
   		valido = 1;
   	 }
   }
   
   if (document.registrar.contrasenia.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.contrasenia.focus();
   		valido = 1;
   	 }
   }   

   if (document.registrar.conocer.value.length < 1) {
  	 if(valido == 0){
   		document.registrar.conocer.focus();
   		valido = 1;
   	 }
   }
   
   if(valido==1) 
	 return(false);  
}