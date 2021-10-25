<?php 
    session_start();
    include("db.php");

    if(isset($_GET['id'])){
        $id_cat = $_GET['id'];
        $consultaeliminar = "DELETE FROM categoria_prod_menu
        WHERE id_cat_prod_menu =  $id_cat";
        $res_elim_cat = mysqli_query($conexion,$consultaeliminar);

        if(!$res_elim_cat){
            die("diablos");
        }

        $_SESSION['mensaje'] = "Categoría eliminada";
        $_SESSION['tipo_mensaje'] = "danger";
        header("Location: inv-alm-categoria.php");
    }

?>