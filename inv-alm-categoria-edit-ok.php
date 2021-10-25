<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnactualizar'])) 
    {
        if (strlen($_POST['nombre']) >= 1) 
        {
            $id_cat = $_GET['id'];
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);
            //$fechareg = date("d/m/y"); //fecha
            $consultaagregar = "UPDATE categoria_prod_menu SET nombre_cat = '$nombre', descripcion_cat = '$descripcion' 
                                    WHERE id_cat_prod_menu = $id_cat";
            mysqli_query($conexion,$consultaagregar);
            $_SESSION['mensaje'] = "Categoría actualizada";
            $_SESSION['tipo_mensaje'] = "primary ";
            header("Location: inv-alm-categoria.php");
        }
    }
?>