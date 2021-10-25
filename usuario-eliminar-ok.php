<?php 
    session_start();
    include("db.php");

    if(isset($_GET['id'])){
        $id_cat = $_GET['id'];
        $consultaeliminar = "DELETE FROM usuarios
        WHERE 	id_usuario =  $id_cat";
        $res_elim_cat = mysqli_query($conexion,$consultaeliminar);

        if(!$res_elim_cat){
            die("error");
        }

        $_SESSION['mensaje'] = "categoria eliminada";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: usuario.php");
    }

?>