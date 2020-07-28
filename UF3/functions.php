<?php


function conexion(){
    /*
         obrir connexió a la db
         fer consulta amb les credencials
         comprovar que ha tornat UN resultat
     */   
     // dades de configuració
   // Para conectarnos a BBDD pasamos los parametros en variables globales pues se utilizan a menudo§©
     $servername = "localhost";
     $username="root";
     $password="";
     $dbname="projecte";
     $conn = new mysqli($servername, $username, $password, $dbname);
     if (!$conn)  {
         echo "Ha fallat la connexió a MySQL: " . mysqli_connect_errno();
         echo "Ha fallat la connexió a MySQL: " . mysqli_connect_error();
     }
     return $conn;
 }




// Funcion para verificar si el usuario y contraseña son validos (pasados como parametro).
// Si es correcto eliminamos la session bienvenido (del registro) y devolvemos true
function checkLogin($user, $pass){
    $res = false; 
    $conn = conexion();
    $sql = "SELECT idEmpleados, contraseña  FROM empleados WHERE `idEmpleados` = '$user'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                //echo $row["pass"];
                if ($row["contraseña"] == sha1(md5($pass))){
                    $res = true;
                    $_SESSION["bienvenido"]=null;
                }
            }
        } 
        $conn->close();
    return $res;

}

function checkNivelEmp($user){
    $res = false; 
    $conn = conexion();
    $sql = "SELECT admin FROM empleados WHERE `idEmpleado` = '$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                //echo $row["pass"];
                $res =  $row["admin"];
            }
        }
        $conn->close();
    return $resultado;
}




//AREA DE FUNCIONS PER RECUPERACIO DE MAIL


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Funcion que genera una cadena de texto random,con la cual se forma
// la contraseña aleatoria que se envia en el mail al user.

function generaClave($long){

    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $long;$i++){
     $key .= $pattern{mt_rand(0,$max)};
    }
    return $key;

}


// Funcion para enviar el correo con la contraseña de recuperación

function sendEmail($correo,$titulo,$mensaje){

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    $enviado=false;
    
    try {
        //Server settings
       // $mail->SMTPDebug = 2;                   // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'hecllorente@gmail.com';                     // SMTP username
        $mail->Password   = 'lchfgpjpnnulpdyn';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('hecllorente@gmail.com', 'Hector Hk');
        $mail->addAddress("$correo", "$correo");     // Add a recipient
        
    
        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "$titulo";
        $mail->Body    = "$mensaje";
       
    
        $mail->send();
    
        $enviado=true;
    
        echo 'Message has been sent<br>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    return $enviado;

    }

    // Actualiza la contraseña del user cuando se le manda el correu con el recovery
    
    function actualizaKey($id_user,$newkey){

        $con=conexion();
        $sql= "UPDATE usuaris SET contrasenya='$newkey' WHERE usuari='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return $valor_consulta;

    }

    // Realizo una consulta para encontrar el row donde está el usuario en concreto que pide el
    // recovery.


    function consultaEmail($id_user){

        $con=conexion();
        $sql= "SELECT * FROM usuaris WHERE mail='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return mysqli_fetch_assoc($valor_consulta);


    }

   



    


    





?>