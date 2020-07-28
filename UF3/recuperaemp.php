<?php



include("functions.php");
use PHPMailer\PHPMailer;
use PHPMailer\SMTP;
use PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_REQUEST['recovery'])){
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    

    $mail_usuari=$_POST["mail"];           
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
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script src="jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
        <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    
    </head>


<body>

<div class="container">
    </form>
            <fieldset>
               <p>Para recuperar la contraseña has de poner tu correo.
            En caso de que tu correo exista se te enviará un correo con un link</p>
    
            <form method="post" class="form-row" id="myform">
    
                <div class="form-group col-md-6">
                    <input class="form-control" type="text" name="mail" id="" placeholder="Mail usuario">
    
                </div>
               
               
               
                <div class=" col-md-6">
                <input type="submit" class="form-control  btn btn-info" name="recovery" value="Recuperar">
    
                </div>
            </fieldset>
            </form>
</div>
<?php
}
?>
        <!-- incluimos el footer en todas las paginas -->
        <?php require_once('footer.php'); ?>
</body>
</html>






