//FUNCION DE CARGA DE OTRAS PÁGINAS EN LISTA DE BIENVENIDA

$(document).ready(function(){
	$("ul#menu li a").click(function(){
    	$("#contenedor").load($(this).attr("data-link"),function(responseTxt,statusTxt,xhr){
        
            });
        });
});

//FUNCION DE CARGA DE ELEMENTOS EN LISTA LATERAL DE CONTENIDO

function content(){
   $("#entradablog").load("entradas/pvp.html")
   $("ul#contenido li a").click(function(){
	$("#entradablog").load($(this).attr("data-link"),function(responseTxt,statusTxt,xhr){
        
            });
        });
};




//FUNCION VALIDACION FORM. HE INTENTADO VALIDARLA CON JQUERY PERO ME HA SIDO IMPOSIBLE, ASI QUE HE TENIDO QUE RECURRIR A JAVASCRIPT BASICO AUNQUE SEA MENOS OPTIMO Y ALGUNAS FUNCIONES SEAN REPETITIVAS

function nombre(){
	var res = false;
	var nbre = document.getElementById("named").value;
		if (nbre!="" && !(/^\s+$/.test(nbre))) {
			res = true;
		}else{
			document.getElementById("errorname").style.display="block";
		}
	return res;
}

function apellido(){
	var res = false;
	var apellido = document.getElementById("lastname").value;
		if (apellido!="" && !(/^\s+$/.test(apellido))) {
			res = true;
		}else{
			document.getElementById("errorlastname").style.display="block";
		}
	return res;
}
				
function telefono(){
    var res = true;
    var numero = document.getElementById("tphone").value;
        if(!(/^\+\d{2,3}\s\d{3}\-\d{2}\-\d{2}\-\d{2}$/.test(numero))){
            res = false;
            document.getElementById("errorphone").style.display="block";
        }else {
        	res = true;
        }
    return res;
}

function fechanac(){
	var res = false;
	var data= document.getElementById("bdate").value;
		if (data!="" && !(/^\s+$/.test(data))) {
			res = true
		}else{
			document.getElementById("errordate").style.display="block";
		}
	return res;
}

function genero(){
	res=false;
	opciones = document.getElementsByName("sexo");
	cantidad = opciones.length;
	for(var i=0; i<cantidad; i++) {
		 if(opciones[i].checked) {
			  res = true;
			  break; 
			  }else{
		document.getElementById("errorgender").style="color:red; font-size:10px;display:block";
		res=false;
			  }
	}
	return res;
}

function vmail(){
	var res = false;
	var correo = document.getElementById("correo").value;
		if ((/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/.test(correo))){
		res = true;
		}else{
		document.getElementById("errormail").style.display="block";
		}
	return res;
}

function vpassword(){
	var res = false;
	var psword = document.getElementById("pword").value;
  		if (psword.length >=8){
  		var mayusc = false;
		var minusc = false;
		var num = false;
				
			for(i=0; i<psword.length; i++){

				
				if(psword.charCodeAt(i)>=65 && contrasenya.charCodeAt(i)<=90){
					mayusc = true;
				}else if(pword.charCodeAt(i)>=97 && contrasenya.charCodeAt(i)<=122){
					minusc = true;
				}else if(pword.charCodeAt(i)>=48 && contrasenya.charCodeAt(i)<= 57){
					num = true;
				}
			}
				if(mayusc && minusc && num){
					res= true;
				}else{
					document.getElementById("errorpword").style.display="block";
				}
					
		}else{
			document.getElementById("errorpword").style.display="block";
		}
	return res;
}

function condiciones(){
    var res = false;
    var caja = document.getElementById('conditions');
        for(i=0; i<caja.length; i++){
            if (caja[i].checked){
                res = true;
                break;
            }
            else{
                document.getElementById("errorbox").style.display='block';
            }
        }
    return res;
}

function validar(){
	res = true;
	if (!nombre()) {
			res = false;
	}
	if (!apellido()) {
			res = false;
	}
	if (!telefono()) {
			res = false;
	}
	if (!fechanac()) {
			res = false;
	}
	if (!genero()) {
			res = false;
	}
	if (!vmail()) {
			res = false;
	}
	if (!vpassword()) {
			res = false;
	}
	if (!condiciones()) {
			res = false;
	}
	return res;
}







/*FUNCIONES GALERIA*/

function agrandar(element) {
       document.getElementById("grande").src = element.src;
       document.getElementById("explain").textContent = element.alt;
}



