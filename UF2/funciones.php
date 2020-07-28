<?php

require_once "phpMailerImport.php";


//AREA DE FUNCIONS DEDICADES A LA CREACIO D'USUARIS A BASE DE DADES

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function conectar(){
    $ip = 'localhost';
    $usuari = 'prova';
    $pass = 'prova';
    $db_name = 'prova';
    // conectamos con la BBDD.//
    $con = mysqli_connect($ip,$usuari,$pass,$db_name);
    if (!$con)  {
        echo "Fallo en la conexión a la BBDD -> MySQL: " . mysqli_connect_errno();
            echo "Fallo en la conexión a la BBDD -> MySQL: " . mysqli_connect_error();
    }
    return $con;
}


// Funcion en la cual mediante un formulario enviado generamos un slot nuevo de información en la BBDD.// 
function addUser($user,$name,$contraseña,$email){

    $con=conectar();
    $sql = "insert into usuaris (usuari,nom,contrasenya,mail) values (\"$user\",\"$name\",\"$contraseña\",\"$email\")";
    $valor_consulta= mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;  
}

// Funcion para recuperar contraseñas de la BBDD
function getPassword(){
    $con=conectar();
    $sql = "SELECT contrasenya FROM usuaris" ;
    $valor_consulta = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;

}


// Funcion para consultar los datos que hay en la BBDD y mostrarlos en la tabla//
function consultorio(){
        
    $con=conectar();
    $sql= "SELECT * FROM noticies" ;
    $valor_consulta=mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    $nFilas=mysqli_num_rows($valor_consulta);

    return $valor_consulta;

}

//AREA DE LOGIN
// Funcion para hacer el login correcto
function checkLogin($usuari,$contrasenya){

    $torna=false;
 
    $con= conectar();
    $sql = 'SELECT * FROM usuaris where usuari ="'.$usuari.'" and contrasenya="'.$contrasenya.'" ';
    $resultado = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    $nfilas = mysqli_num_rows($resultado);
    mysqli_close($con);

    if($nfilas==1){
        $torna=true;
    }

    return $torna;
}


//AREA DE FUNCIONS PER VISUALITZAR NOTICIES
// Funcion para mostrar la tabla
function listNews(){
    $noticias = false;
    $conexion = conectar();

    echo "<table>";

    //consulta
    $sql ="SELECT * FROM noticies";
    $result = mysqli_query($conexion,$sql) or die('Consulta fallida: ' . mysqli_error($conexion));
    $result2 = mysqli_query($conexion,$sql) or die('Consulta fallida: ' . mysqli_error($conexion));

        if (mysqli_num_rows($result) >=0){
            $listado = true;
            $contador = 0;

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $idpubli=$row["idPubli"];
                
                if($contador==0){
                    echo "<tr>";
                    foreach ($row as $cabecera => $value){
                        echo "<th>$cabecera</th>";
                    }
                    echo "</tr>";
                }
                $contador++;
            }   
            while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                $idpubli=$row2["idPubli"];

                
                    echo "<tr>";
                    foreach ($row2 as $cabecera => $value){
                        echo "<th>$value";

                        
                        
                    }
                    echo "<input type='button' name='delete' id='delete' value='esborra' onclick='deleteNews($row2[idPubli])'";

                    echo "</tr>";
                
            }   
            echo "</tr>";

                            
        }
    mysqli_close($conexion);
    return $listado;  
}
 /*usuari = $_SESSION[nom] and*/
// Funcio per eliminar noticies
function deleteNews($idPubli){
    $con = conectar();
    $sql = "DELETE from noticies WHERE idPubli = '$idPubli'";
    $valor_consulta= mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    mysqli_close($con);
    return $valor_consulta;
}


function addNews($user,$titol,$publi){

    $con=conectar();
    $sql = "insert into noticies (usuari,titolNoticia,cosNoticia) values (\"$user\",\"$titol\",\"$publi\")";
    $valor_consulta= mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
    mysqli_close($con);

    return $valor_consulta;
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

        $con=conectar();
        $sql= "UPDATE usuaris SET contrasenya='$newkey' WHERE usuari='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return $valor_consulta;

    }

    // Realizo una consulta para encontrar el row donde está el usuario en concreto que pide el
    // recovery.


    function consultaEmail($id_user){

        $con=conectar();
        $sql= "SELECT * FROM usuaris WHERE mail='$id_user'";
        $valor_consulta=mysqli_query($con,$sql) or die ('Consulta fallida:'.mysqli_error($con));
        mysqli_close($con);
    
        return mysqli_fetch_assoc($valor_consulta);


    }

   

    


    


    




?>