<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include('funciones.php');
     
            
            $nick="";
            $name="";                     
            $email="";           
            $passwd="";
          
      
        if(isset($_REQUEST['enviar'])){
            $nick=$_REQUEST["user"];
            $name=$_REQUEST["nombre"];
            //$passwd=md5($_REQUEST["key"]);  
            $passwd=$_REQUEST["key"];         
            $email=$_REQUEST["email"];
          
            

            if(addUser($nick,$name,$passwd,$email,)){                          
            header('location:index.php');
            echo "usuario añadido"."<br>";
            }
            
        }
     
      
    
    ?>
</head>
<body>
    <form method="post">
        <fieldset>
            <legend>Registro de nuevo usario</legend>
                Id:<input type="text" name="user"id="user" value='<?php echo "$nick";?>'><br>
                Nombre:<input type="text" name="nombre"id="nombre" value='<?php echo "$name";?>'><br>
                Contraseña <input type="password" name="key" id=""><br>
                Correo: <input type="text" name="email" id="email" value='<?php echo "$email";?>'><br>
                <input type="submit" name="enviar" id="" value="Registrar">
                
                
    
        </fieldset>
    </form>
</body>
</html>