<?php 
    include("db.php");
        $nombre_producto = $_GET["var"];
        $nombre_ingrediente = trim($_POST['ingrediente']);
        $un_medida = trim($_POST['unimedida']);
        $cantidad = trim($_POST['efectivo']);
        $excluir = trim($_POST['excluir']);


//ingrediente
    
        $consulta5="SELECT * FROM producto_inventario WHERE id_producto_inv ='$nombre_ingrediente' ";
        $registro5=mysqli_query($conexion, $consulta5) or die("Problemas en la consulta: ".mysqli_error($conexion));

        if ($datos5=mysqli_fetch_array($registro5)) {
            $idproducto=$datos5['id_producto_inv'];
        }

        
        $consulta="INSERT INTO producto_ingrediente (id_producto, id_ingrediente, id_uni_m, cantidad, exclusion) 
                    VALUES ('$nombre_producto','$idproducto', '$un_medida', '$cantidad','$excluir')";
        $resultado2 = mysqli_query($conexion,$consulta);

        if ($resultado2){
            $url = $_SERVER['HTTP_REFERER'];
            header("LOCATION:$url");
            
        } else{
            echo '<script> alert("Error") </script>';
        }
?>