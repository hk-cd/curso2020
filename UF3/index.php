<?php

//llamamos al archivo con todos los datos de la BBDD y algunas funciones
require_once('functions.php');

// Miramos si tiene la cookie remember, si es así la miramos e intetamos hacer login
if(isset($_COOKIE['remember'])){
    $cookie = json_decode($_COOKIE["remember"], true);
    if(checkLogin($cookie['id'], $cookie['hash'])){
        $_SESSION["login"] = $cookie['id'];
        if(isset($_REQUEST["remember"])){
            setCook($cookie['id'], $cookie['hash']);
        }
        header("location:noticias.php");
    }
}

// Si ha rellenado el formulario verificamos el usuario  contrasña, si el usuario ha aceptado remember el login generamos la cookie y redirimos a la pagina de noticias
// Sino solo redirigimos
if(isset($_REQUEST["enviar"])){
    if(checkLogin($_REQUEST["user"], $_REQUEST["password"])){
        $_SESSION["login"] = $_REQUEST["user"];
        // echo "login correto";
        if(isset($_REQUEST["remember"])){
            setCook($_REQUEST["user"], sha1(md5($_REQUEST["password"])));
        }
        $_SESSION["admin"] = checkNivelEmp($_REQUEST["user"]);
        header("location:noticias.php");
    }else{
       echo '<div class="alert alert-danger" role="alert">
       Usuario o contraseña incorrectos<br></div>';
    }
}


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

    <div class="jumbotron">
        <div class="container">
        <?php
            // Si el usuario se ha registrado tendremos la sesion bienvenido  y mostramos el mensaje sino mostramos un mensje generico
            if( isset($_SESSION["bienvenido"])){
                echo '<h1 class="display-4">Usuario registrado</h1>
                <hr class="my-4">
                <p>Inicia sesión con tus credenciales</p>';
            }else{
                echo '<h1 class="display-4">Inicio sesión</h1>
                <p class="lead">Tu sesión es la de un usuario que no ha sido registrado.</p>
                <hr class="my-4">
                <p>Si no tienes usuario y contraseña, almacena tus datos a través de nuestro formulario.</p>
                    <a class="btn btn-info " href="registroEmpleado.php" role="button">Registrar</a>
                    ';
            }
        ?>
        
        </div>
    </div>
    <div class="container">
        <p>Para el test utilizar <strong>Hector</strong> y <strong>123Aa@</strong>  o regístrate y utiliza tus credenciales</p>

        <form class="form-row">

            <div class="form-group col-md-6">
                <input class="form-control" type="text" name="user" id="" placeholder="Nombre de usuario">
            </div>
            <div class="form-group col-md-6">
                <input class="form-control" type="password" name="password" placeholder="Contraseña" id="">
            </div>
            <div class="form-check form-group form-check-inline col-md-6">
                <input class="form-check-input ml-2" type="checkbox" id="inlineCheckbox2" name="remember"
                    value="option2">
                <label class="form-check-label" for="inlineCheckbox2">Recordar sesión</label><br>
            </div>
            <div class="form-check form-group form-check-inline col-md-6">
                <a href="recuperaemp.php" >Recuperar contraseña</a><br>
            </div>
            <div class="col-md-6">
            <input class="form-control btn btn-outline-success " type="submit" value="Iniciar sesión" name="enviar">
            </div>
            <div class=" col-md-6">
            <a class="form-control  btn btn-info " href="registroEmpleado.php" role="button">Registrar</a>
            </div>

        </form>
    </div>
    <!-- incluimos el footer en todas las paginas -->
    <?php require_once('footer.php'); ?>
</body>
</html>