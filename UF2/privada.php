<?php
session_start();
include ('funciones.php');

if(isset($_REQUEST["logout"])){
    $_SESSION=null;
    session_destroy(); 
    setcookie("password",0,1);
    setcookie("nomusuari",0,1);

    header('Location:index.php');           

}


if(isset($_SESSION["login"])&&$_SESSION["login"]==true){
?>
Bienvenido......<?=$_SESSION["nom"]?>

<a href="privada.php?logout">[logout]</a>
<?php
}else{
    header('Location:index.php');           

}
if(isset($_GET['erase'])){
    eliminarNews($identificador);
    $identificador=$_REQUEST['erase'];
    
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
    <a href="addnoticia.php">Afegir Noticia</a>

        <?php
        
        listNews();


        ?>
    </table><br><br>
    <p>Generar pdf</p><br>
    <button><a href="createPdf.php">Obtener pdf</a></button>
</body>
</html>