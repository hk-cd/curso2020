<?php


include("funciones.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMAILER/PHPMailer/src/Exception.php';
require 'PHPMAILER/PHPMailer/src/PHPMailer.php';
require 'PHPMAILER/PHPMailer/src/SMTP.php';


if(isset($_REQUEST['recovery'])){
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    

    $mail_usuari=$_POST["nom_user"];           
    $consulta=consultaEmail($mail_usuari);

    echo $mail_usuari."<br>";
    print_r($consulta); 
   
  
        if($consulta['mail']==$mail_usuari){
            
            
            $code=generaClave(10);
            $correu=sendEmail($mail_usuari,"Recuperacion de constraseña", $code);
                
            echo "<br>".$code."<br>";
            actualizaKey($mail_usuari,$code);

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
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <form action="recuperacioMail.php" method="post">
        <fieldset>
            <legend>Formulario de Recuperacion de contraseña</legend><br>
                
                Email Usuario: <input type="text" name="nom_user" id=""><br>
               <input type="submit" name="recovery" id="" value="Recover">
        
        </fieldset>
    
    </form>
<?php
}
?>
    
</body>
</html>






