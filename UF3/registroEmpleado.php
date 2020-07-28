<?php
echo "Registro empleado";

//Objetivo: Un form validado con Javascript que envía la info a la DB en PHP..


?>




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

    <div class="container">

<form method="post" id="myform">
    <form class="row mx-0">
        <legend>Formulario de Registro</legend>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="nombre" id="nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="apellido">Apellido</label>
                <input class="form-control" type="text"  name="apellido" id="apellido">
               
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="edad">Edad</label>
                <input class="form-control" type="date"  name="edad" id="edad">
               
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input class="form-control" type="text"name="email" id="email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="col-12" name="password" id="password"
                    data-error="Introduce una contraseña">
            </div>
            <div class="form-group  col-md-6">
                <label for="password2">Repite Password</label>
                <input type="password" class="col-12"  name="password2" id="password2"
                    data-error="Repite la contraseña">
            </div>
            <div class="error"></div><br>
        </div>
        <input type="submit" class="btn btn-outline-info" value="Enviar">



    </form>

</div>
    <?php require_once('footer.php'); ?>

</body>

</html>