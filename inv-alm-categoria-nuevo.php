<?php 
    session_start();
    include("db.php");

    if(isset($_POST['guardar_cat'])) 
    {
        if (strlen($_POST['nombre']) >= 1) 
        {
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "INSERT INTO categoria_prod_menu(nombre_cat, descripcion_cat) VALUES ('$nombre', '$descripcion')";
            $resultadoaagregar = mysqli_query($conexion,$consultaagregar);
            if ($resultadoaagregar) {
                $_SESSION['mensaje'] = "Categoría guardada";
                $_SESSION['tipo_mensaje'] = "primary";
                header("Location: inv-alm-categoria.php");
            } else {
                $_SESSION['mensaje'] = "¡Ups ha ocurrido un error!";
                $_SESSION['tipo_mensaje'] = "primary";
                header("Location: inv-alm-categoria.php");
            }
        }
        else{
            $_SESSION['mensaje'] = "¡Por favor complete los campos!";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: inv-alm-categoria.php");
        }
    }
?>