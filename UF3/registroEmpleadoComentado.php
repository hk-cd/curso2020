

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrarte</title>
    <script src="jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar navbar-light bg-light" id="formulario">
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="text" name="nom" id="" placeholder="Nombre de usuario"><br>
            <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password" id=""><br>
            <input class="form-control mr-sm-2 " type="checkbox" name="recordar" id="">Recordar login<br>
            <input class="form-control mr-sm-2 ml-sm-2" type="submit" value="enviar" name="enviar">
        </form>
    </nav>

    <?php/*
    // define variables and set to empty values
    $nombre = $email = $apellido = $edad = $password = $password2 = $nacimiento = "";
    $error_nombre = $error_email  = $error_passwords = $error_apellido = $error_edad = $error_password = $error_password2 = "";
    $errclass_nombre = $errclass_email =  $errclass_apellido = $errclass_edad = $errclass_password  = $errclass_edad = "";
    $errclass = "class='error'";
    $formok = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = clean($_POST["nombre"]);
        $apellido = clean($_POST["apellido"]);
        $email = clean($_POST["email"]);
        $edad = clean($_POST["edad"]);
        $password = clean($_POST["password"]);
        $password2 = clean($_POST["password2"]);


        if (empty($nombre)){
            $error_nombre = "Introduce un nombre, es obligatorio.";
            $errclass_nombre = $errclass;
            $formok = false;
        }else{
            // Miramos por la expresion regular si tiene mayusculas o minusculas, lo unico permitido
            $fornombreok = !(preg_match('/^[a-zA-Z]+$/', $nombre));
            if ($fornombreok) {
                $error_nombre = "Introduce un nombre, no son validas los numeros.";
                $formok = false;
            }
        }
        if (empty($apellido)){
            $error_apellido = "Introduce tu apellido, es obligatorio.";
            $errclass_apellido = $errclass;
            $formok = false;
        }
        // Miramos que no este vació y llamamos a la funcion para verificar el mail
        if ((empty($email) || !validateEmail($email))){
            $error_email = "Introduce un correo valido, es obligatorio.";
            $errclass_email = $errclass;
            $formok = false;
        }
        if (empty($password)){
            $error_password = "Introduce un password.";
            $errclass_password = $errclass;
            $formok = false;
        }
        if (empty($edad)){
            $error_edad = "Tienes que poner tu edad.";
            $errclass_edad = $errclass;
            $formok = false;
        }
        if(!empty($edad) && !mayor_edad($edad)){
            $error_edad = "Tienes que ser mayor de edad.";
            $errclass_edad = $errclass;
            $formok = false;
        }else{
            $nacimiento=$edad;
        }
        if (empty($password2)){
            $error_password2 = "Repite el password.";
            $errclass_password2 = $errclass;
            $formok = false;
        }
        if (($password != $password2) && (!empty($password)) ){
            $error_passwords = "Las contraseñas no coinciden.<br>";
            $formok = false;
        }
        if (!validarPass($password)){
            $error_passwords .= "Las contraseñas tienen que tener 1 mayúscula, 1 minúscula, 1 digito y un caracter especial y tener minímo 6 caracteres y máximo 8";
            $formok = false;
        }
    
        
        
        }
function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function validarPass($password){
    $resultado = true;
        $matchletrasmin = preg_match('/[a-z]/', $password);
        $matchletrasmay = preg_match('/[A-Z]/', $password);
        $matchNumeros = preg_match('/\d/', $password);
        $matchEspeciales = preg_match('/[^a-zA-Z\d]/', $password);
        //echo "matchletrasmin -> $matchletrasmin matchletrasmay -> $matchletrasmay matchNumeros -> $matchNumeros matchEspeciales -> $matchEspeciales ";
        if (!$matchletrasmin || !$matchletrasmay || !$matchNumeros || !$matchEspeciales || (strlen($password)<6) || (strlen($password)>8)){
            $resultado = false;
            $formok = false;
        }
    return $resultado;
}


if ($formok == true && validarPass($password)){
// echo "guardar los datos";
    if (addUser($nombre,$apellido, $nacimiento, $email, $password))
    {
        $_SESSION["bienvenido"] = true;
        header("location:index.php");
    };
}*/
?>
<!--
    <div class="container">

        <form method="post" <?phpaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"?> id="myform">
            <form class="row mx-0">
                <legend>Formulario de Registro</legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre<span <?= $errclass_nombre; ?>>*</span></label>
                        <input class="form-control" type="text" value="<?=$nombre;?>" name="nombre" id="nombre">
                        <div class="error"><?=$error_nombre;?></div><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellido">Apellido<span <?= $errclass_apellido; ?>>*</span></label>
                        <input class="form-control" type="text" value="<?=$apellido;?>" name="apellido" id="apellido">
                        <div class="error"><?=$error_apellido;?></div><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edad">Edad</label>
                        <input class="form-control" type="date" value="<?=$edad;?>" name="edad" id="edad">
                        <div class="error"><?=$error_edad;?></div><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email<span <?= $errclass_email; ?>>*</span></label>
                        <input class="form-control" type="text" value="<?=$email;?>" name="email" id="email">
                        <div class="error"><?=$error_email;?></div><br>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="col-12" value="<?=$password;?>" name="password" id="password"
                            data-error="Introduce una contraseña">
                        <div class="error"><?=$error_password;?></div>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="password2">Repite Password</label>
                        <input type="password" class="col-12" value="<?=$password2;?>" name="password2" id="password2"
                            data-error="Repite la contraseña">
                        <div class="error"><?=$error_password2;?></div>
                    </div>
                    <div class="error"><?=$error_passwords;?></div><br>
                </div>
                <input type="submit" class="btn btn-outline-info" value="Enviar">



            </form>

    </div-->