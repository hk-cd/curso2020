<?php
session_start();
include("funciones.php");

$error="";

if (isset($_GET["nuevo"])){
    $error="Nuevo usuario creado, adelante ".$_GET["nuevo"];
}

if (isset($_GET["error"])){
    $error="No has entrado los datos del nuevo usuario.";
}

if(isset($_SESSION["login"])){
    if (chequeoUser($_SESSION["nom"],$_SESSION["password"])){
        header('Location:ejemplo_privado.php');           
    }
}

if(isset($_COOKIE["password"])){
    if (chequeoUser($_COOKIE["nomusuari"],$_COOKIE["password"])){
        $_SESSION["login"]=true;
        $_SESSION["nom"]=$_COOKIE["nomusuari"];
        $_SESSION["password"]=$_COOKIE["password"];
        header('Location:ejemplo_privado.php');  

    }else{
        $error="credenciales incorrectas";
    }

         

}

if(isset($_REQUEST["submit"])){
        $password=md5($_REQUEST["password"]);
        if(chequeoUser($_REQUEST["username"],$password)){
            $_SESSION["login"]=true;
            $_SESSION["nom"]=$_REQUEST["username"];
            $_SESSION["password"]=$password;
            if(isset($_REQUEST["recordar"])&&$_REQUEST["recordar"]==1){
                setcookie("password",$password,time()+365*24*60*60);
                setcookie("nomusuari",$_REQUEST["username"],time()+365*24*60*60);

            }

            header('Location:ejemplo_privado.php');           
        }else{
            $error="Usuario o contraseña incorrecta.";
        }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?=$error?>


    <form  method="post">
    User:<input type="text" name="username" id=""><br>
    Pass:<input type="password" name="password" id=""><br>  
    Recordar: <input type="checkbox" name="recordar" value="1"><br>
    <button><a href="recuperar.php">¿Has olvidado tu contraseña?</a></button><br>
    <input type="submit" name="submit" value="Entrar">
    <button><a href="registrar_persona.php">Registrarse</a></button>
   
    </form>

</body>
</html>