<?php

include "funciones.php";
session_start();


echo "User: admin o profe<br>";
echo "Password: 1234";

//SUBMIT AMB REDIRECCIÓ A LA PÀGINA DE REGISTRE
if (isset($_REQUEST["register"])) {
	header("location:signUp.php");
}

//SUBMIT AMB REDIRECCIÓ A PÀGINA PRIVADA I CREACIÓ DE COOKIES
if(isset($_REQUEST["login"])){
	if(checkLogin($_POST["user"],$_POST["password"])){
	$_SESSION["login"]=true;
	$_SESSION["nom"]=$_REQUEST["user"];

	if(isset($_REQUEST["autologin"])){
		setcookie("password",$_REQUEST["password"],time()+365*24*60*60);
		setcookie("nomusuari",$_REQUEST["user"],time()+365*24*60*60);
	}
		header('location:privada.php');
}else{
	echo "Usuario o contraseña incorrecta";
}
}

//REDIRECCIÓ AUTOMÀTICA SI LES COOKIES JA EXISTEIXEN
if(isset($_COOKIE["nomusuari"])&&isset($_COOKIE["password"])){
	header("location:privada.php");
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
		<h1>PROVA FINAL MODUL</h1>
	</div>
	<div id="login">
		<form method="post">
			<fieldset>
				<legend>Login</legend>
				Username: <input type="text" name="user"><br><br>
				Password: <input type="password" name="password"><br><br>
				<input type="checkbox" name="autologin"> Remember me<br><br>
                <button><a href="recuperacioMail.php">¿Has olvidado tu contraseña?</a></button><br><br>
				<input type="submit" name="login" value="Sign In">
				<input type="submit" name="register" value="Sign Up">
			</fieldset>
		</form>
	</div>
	<hr>
</body>
</html>