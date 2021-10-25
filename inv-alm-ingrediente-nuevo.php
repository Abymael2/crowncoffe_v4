<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnagregar'])) 
    {
        if (strlen($_POST['nombre']) >= 1 && strlen($_POST['costo']) >= 1 && strlen($_POST['unimedida']) >= 1) 
        {
            $nombre = trim($_POST['nombre']);
            $costo = trim($_POST['costo']);
            $unimedida = trim($_POST['unimedida']);
            $udispon = trim($_POST['udipon']);
            $descripcion = trim($_POST['descripcion']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "INSERT INTO producto_inventario(nombre_prod_inv, costo_prod_inv, u_medida_prod_inv, u_disp_prod_inv, descrip_prod_inv) 
                            VALUES ('$nombre', '$costo', '$unimedida', '$udispon', '$descripcion')";
            $resultadoaagregar = mysqli_query($conexion,$consultaagregar);
            if ($resultadoaagregar) {
                $_SESSION['mensaje'] = "categoria guardada";
                $_SESSION['tipo_mensaje'] = "primary";
                header("Location: inv-alm-ingrediente.php");
            } else {
                $_SESSION['mensaje'] = "¡Ups ha ocurrido un error!";
                $_SESSION['tipo_mensaje'] = "primary";
                header("Location: inv-alm-ingrediente.php");
            }
        }
        else{
            $_SESSION['mensaje'] = "¡Por favor complete los campos!";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: inv-alm-ingrediente.php");
        }
    }
?>