<?php

session_start();

// Si se recibe la variable logout eliminaremos todas las cookies y sesiones y redirigiremos a la pagina principal.
if (isset($_REQUEST["logout"])){
    $_SESSION=null;
    session_destroy();
    setcookie("recordar", null, 0);
    header("location:index.php");
}
// Como es una pagina que esta incluida en todas las paginas privadas y no privadas realizamos expciones para evitar el redireccionaiento cuando no tienen session

if (!isset($_SESSION["login"]) && (basename($_SERVER['PHP_SELF'])!= 'index.php' && basename($_SERVER['PHP_SELF'])!= 'registrarte.php' && basename($_SERVER['PHP_SELF'])!= 'recuperar.php')){
        header("location:index.php");
}
if (isset($_SESSION["login"]) && (basename($_SERVER['PHP_SELF'])== 'index.php') ){
    header("location:noticias.php");
}

//si tenemos la variable session login mostramos el siguiente codigo html
if (isset($_SESSION["login"])){
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="noticias.php"><img src="img/logo-facebook.png" alt="Facebook"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="noticias.php">Muro de publicaciones <span class="sr-only">(current)</span></a>
            </li>
            <?php
        if ($_SESSION["admin"]){
            ?>
            <li class="nav-item ">
            <a class="nav-link" href="noticias-admin.php">Editar Noticias <span class="sr-only">(current)</span></a>
        </li>
        <?php
        }
            ?>
           
            <li class="nav-item">
                <a class="nav-link" href="agregar-noticias.php">Agregar noticias</a>
            </li>

        </ul>
        <span class="px-2">Bienvenido <?= $_SESSION["login"] ?></span><a class="btn btn-outline-success my-2 my-sm-0"
            type="submit" href="?logout">Logout</a>
    </div>
</nav>
