<?php

include("funciones.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_REQUEST['recovery'])){
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    

    $nom_usuari=$_POST["nom_user"];           
    $consulta=consultaEmail($nom_usuari);

    echo $nom_usuari."<br>";
    print_r($consulta); 
   
  
        if($consulta['email']==$nom_usuari){
            
            
            $code=generaClave(10);
            $correu=sendEmail($nom_usuari,"Recuperacion de constraseña", $code);
                
            echo "<br>".$code."<br>";
            actualizaKey($nom_usuari,$code);

        }else{
            echo 'No estás registrado';
        }
    }




}else{





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="recuperar.php" method="post">
        <fieldset>
            <legend>Formulario de Recuperacion de contraseña</legend>
                
                Nom_Usuari:<input type="text" name="nom_user" id=""><br>
               <input type="submit" name="recovery" id="" value="Recover">
        
        </fieldset>
    
    </form>
<?php
}
?>
    
</body>
</html>