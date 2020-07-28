<?php

session_start();
include("funciones.php");

$user="";
$nombre="";
$email="";
$password1="";
$password2="";

$euser="";
$enombre="";
$eemail="";
$epassword1="";
$epassword2="";


$errores=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user=test_input($_REQUEST["user"]);
	$nombre=test_input($_REQUEST["name"]);
	$email=test_input($_REQUEST["mail"]);
	$password1=test_input($_REQUEST["contrasenya"]);
	$password2=test_input($_REQUEST["password2"]);

    if (!preg_match("/^[a-zA-Z]+$/",$user)) {
        $euser = "Only letters";
        $errores=true;
        $user="";
    }

    if (!preg_match("/^[a-zA-Z]+$/",$nombre)) {
        $enombre = "Only letters";
        $errores=true;
        $nombre="";
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eemail = "Invalid email format";
        $errores=true;
        $email="";
    }

    if($password1!=$password2){
        $epassword1 = "Passwords must coincide";
        $errores=true;
        $password1=$password2="";

    }else{

        $tieneLetras=preg_match("/[a-zA-Z]/",$password1);
        $tieneNumeros=preg_match("/[\d]/",$password1);
        $tieneEspeciales=preg_match("/[^a-zA-Z\d]/",$password1);
        $tieneLongitudMin=strlen($password1)>=6?true:false;
        $tieneLongitudMax=strlen($password1)<=8?true:false;
        $tieneMayus=preg_match("/[A-Z]/",$password1);
        $tieneMinus=preg_match("/[a-z]/",$password1);

        if(!$tieneLetras){
            $epassword1 .= "It's empty";
            $errores=true;
            $password1=$password2="";


        }if(!$tieneNumeros){
            $epassword1 .= "Must contain at least a number";
            $errores=true;
            $password1=$password2="";

        }if(!$tieneEspeciales){
            $epassword1 .= "Must contain at least a special character";
            $errores=true;
            $password1=$password2="";
        }if(!$tieneLongitudMin){
            $epassword1 .= "Between 6 and 8 characters";
            $errores=true;
            $password1=$password2="";
        }if(!$tieneLongitudMax){
            $epassword1 .= "Between 6 and 8 characters";
            $errores=true;
            $password1=$password2="";
        }if(!$tieneMayus){
        	$epassword1 .= "Must contain at least one Uppercase";
        	$errores=true;
			$password1=$password2="";        	
        }if(!$tieneMinus){
        	$epassword1 .= "Must contain at least one Lowercase";
        	$errores=true;
			$password1=$password2="";
  		}

    	if(!$errores){
            addUser($_POST["user"],$_POST["name"],$_POST["contrasenya"],$_POST["mail"]);
    		//SI TOT ESTÀ CORRECTE FA REDIRECCIÓ A LA PÀGINA LOGIN
        	header("location:index.php");
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="cabecera">
			<h1>SOCIAL NETWORK UF1</h1>
		</div>

		<div id="register">
			<form method="post">
				<fieldset>
					<legend>Sign up</legend>
					User: <input type="text" name="user" id="user"><span style="color:red;"><?=$enombre?></span><br><br>
					Name: <input type="text" name="name" id="name"><span style="color:red;"><?=$enombre?></span><br><br>
					Email: <input type="mail" name="mail" id="mail"><span style="color:red;"><?=$eemail?></span><br><br>
					Password: <input type="password" name="contrasenya" id="contrasenya"><span style="color:red;"><?=$epassword1?></span><br><br>
					Repeat your password: <input type="password" name="password2" id="password2"><span style="color:red;"><?=$epassword2?></span><br><br>
					<input type="submit" name="submit" value="submit">
				</fieldset>
			</form>
		</div>
        <hr>
</body>
</html>