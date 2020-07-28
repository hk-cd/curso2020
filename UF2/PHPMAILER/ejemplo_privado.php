<?php
session_start();
include("funciones.php");

if(isset($_REQUEST["logout"])){
    session_destroy(); 
    setcookie("password",0,1);
    setcookie("nomusuari",0,1);

    header('Location:index.php');           

}

if(isset($_SESSION["login"])&&$_SESSION["login"]==true&&chequeoUser($_SESSION["nom"],$_SESSION["password"])){
?>
Bienvenido......<?=$_SESSION["nom"]?>

<a href="ejemplo_privado.php?logout">[logout]</a>
<?php
}else{
    header('Location:index.php');           

}
?>