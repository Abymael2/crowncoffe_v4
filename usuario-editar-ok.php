<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['nombre']) >= 1) 
        {
            $id_us = $_GET['id'];
            $nombre = trim($_POST['nombre']);
            $password = trim($_POST['contraseña']);
            $permiso = trim($_POST['permiso']);
            $consultaagregar = "UPDATE usuarios 
                SET nombre = '$nombre', contraseña = '$password', permiso = '$permiso' 
                WHERE id_usuario = $id_us";
            mysqli_query($conexion,$consultaagregar);

            $_SESSION['mensaje'] = "categoria Actualizada";
            $_SESSION['tipo_mensaje'] = "primary ";
            header("Location: usuario.php");
        }
    }
?>