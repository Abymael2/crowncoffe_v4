<?php 
    include("db.php");

    if(isset($_POST['btnregistrar'])) 
    {
        if (strlen($_POST['nombre']) >= 1 && strlen($_POST['contraseña']) >= 1) 
        {
            $nombre = trim($_POST['nombre']);
            $contraseña = trim($_POST['contraseña']);
            $permiso = $_POST['permiso'];
            //$fechareg = date("d/m/y"); //fecha
            $consulta = "INSERT INTO usuarios(nombre, contraseña, permiso) VALUES ('$nombre', '$contraseña', '$permiso')";
            $resultado2 = mysqli_query($conexion,$consulta);
            if ($resultado2) {
                ?> 
                <div class="alert alert-primary" role="alert"> agregado correcto</div>
                <?php
            } else {
                ?> 
                <div class="alert alert-danger" role="alert">¡Ups ha ocurrido un error!</div>
                <?php
            }
        }else 
        {
                ?> 
                <div class="alert alert-danger" role="alert">¡Por favor complete los campos!</div>
                <?php
        }
    }
?>