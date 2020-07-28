<?php

// Funcion para no repetir el procedimiento de conexión a la BBDD.//
// Hacemos una consulta para comprobar que la conexión se ha hecho correctamente.//
// En caso contrario muestra un error en pantalla.//

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function conectar(){
    $ip = 'localhost';
    $usuari = 'root';
    $pass = '';
    $db_name = 'democrud';
    // conectamos con la BBDD.//
    $con = mysqli_connect($ip,$usuari,$pass,$db_name);
    if (!$con)  {
        echo "Fallo en la conexión a la BBDD -> MySQL: " . mysqli_connect_errno();
            echo "Fallo en la conexión a la BBDD -> MySQL: " . mysqli_connect_error();
    }
    return $con;
}

// Funcion para consultar los datos que hay en la BBDD y mostrarlos en la tabla//

function consultorio(){

        
    $con=conectar();
    $sql= "SELECT * FROM usuarios" ;
    $valor_consulta=mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    $nFilas=mysqli_num_rows($valor_consulta);

    
    
    return $valor_consulta;

}

// Funcion en la cual mediante un formulario enviado generamos un slot nuevo de información en la BBDD.//

    
function addUser($user,$name,$contraseña,$email){

    $con=conectar();
    $sql = "insert into usuarios (user,nombre,mail,contraseña) values (\"$user\",\"$name\",\"$contraseña\",\"$email\")";
    $valor_consulta= mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;

    

}

// Consulta para que me ponga los valores en los inputs para poder editar los valores.//

function consultaId($identificador){
    $con=conectar();
    $sql="SELECT * FROM usuarios WHERE user='$identificador'";    
    $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
    $n_row=mysqli_fetch_row($valor_consulta);
    mysqli_close($con);

    return $n_row;


}

//Funcion para poder modificar los datos que ya han sido introducidos en la BBDD.//

function editarUser($identificador,$user,$name,$contraseña,$mail){

    $con=conectar();
    
    $sql="UPDATE usuarios SET user='$user',nombre='$name',contraseña='$contraseña',mail='$mail' WHERE user='$identificador'";
    $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;
    
    
}

// Funcion con cual nos permite borrar datos que ya han sido introducidos en la BBDD.//

function eliminarUser($identificador){

    $con=conectar();
    $sql="DELETE FROM usuarios WHERE user='$identificador' ";
    $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;




}

// Funcion para chequear que el usuario y contraseña que introduce el usario 
// se encuentra registrado en la BBDD.

function chequeoUser($user,$clave){

    $con=conectar();
    $sql="SELECT * FROM usuarios WHERE user='$user' and contraseña='$clave'";
    $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;

}

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
        $mail->Username   = 'aberbelbuendia@gmail.com';                     // SMTP username
        $mail->Password   = 'mtgiqmzbbjvdtqoy';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('hecllorente@gmail.com', 'H.Hk');
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

        $con=conectar();
        $sql= "UPDATE usuarios SET contraseña='$newkey' WHERE email='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return $valor_consulta;

    }

    // Realizo una consulta para encontrar el row donde está el usuario en concreto que pide el
    // recovery.


    function consultaEmail($id_user){

        $con=conectar();
        $sql= "SELECT * FROM usuarios WHERE mail='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return mysqli_fetch_assoc($valor_consulta);


    }


?>