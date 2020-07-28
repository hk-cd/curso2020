<?php

session_start();
include ('funciones.php');

//AFEGEIX NOTICIA
if(isset($_POST["afegir"])){
    addNews($_SESSION["nom"],$_POST["titol"],$_POST["noticia"]);
    //tot ok
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
    <form method="post">
        Titol:<input type="text" name="titol" id="titol"><br><br>
        Noticia:<textarea name="noticia" id="noticia" rows="4" cols="50"></textarea><br>
       <input type="submit" value="<?=$accio?>" name="afegir">
    </form>
</body>
</html>
<?php

?>