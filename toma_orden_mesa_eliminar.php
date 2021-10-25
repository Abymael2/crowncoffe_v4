<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btneliminar'])) 
    {
        $mesa = trim($_POST['no_mesa']);
        
        if($mesa == 0){
            $_SESSION['mensaje'] = "!Error al eliminar mesa¡ Seleccione una mesa";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: tomaOrden.php");
        }
        else{
            $consultaeliminar = "DELETE FROM mesa
            WHERE numero  =  $mesa";
            $res_elim_cat = mysqli_query($conexion,$consultaeliminar);

            if(!$res_elim_cat){
                $_SESSION['mensaje'] = "!Error al eliminar mesa¡";
                $_SESSION['tipo_mensaje'] = "danger";
                header("Location: tomaOrden.php");
            }

            $_SESSION['mensaje'] = "Mesa eliminada";
            $_SESSION['tipo_mensaje'] = "primary";
            header("Location: tomaOrden.php");
        }
    }

?>