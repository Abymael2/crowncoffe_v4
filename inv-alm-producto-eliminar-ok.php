<?php 
    session_start();
    include("db.php");

    if(isset($_GET['id'])){
        $id_cat = $_GET['id'];

        $eliminar = "DELETE FROM producto_ingrediente
        WHERE id_producto  =  $id_cat";
        $res_elim = mysqli_query($conexion,$eliminar);

        $consultaeliminar = "DELETE FROM producto_menu
        WHERE id_producto_m  =  $id_cat";
        $res_elim_cat = mysqli_query($conexion,$consultaeliminar);

        

        if(!$res_elim_cat){
            die("error");
        }

        $_SESSION['mensaje'] = "Producto eliminado";
        $_SESSION['tipo_mensaje'] = "primary";
        // redireccionar a la misma pagina
        $url = $_SERVER['HTTP_REFERER'];
        header("LOCATION:$url");
    }

?>