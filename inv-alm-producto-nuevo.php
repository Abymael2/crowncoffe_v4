<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnagregar'])) 
    {
        if (strlen($_POST['nombre']) >= 1 && strlen($_POST['precio']) >= 1) 
        {

            if(isset($_FILES['foto']['name'])){
                // binarios de imagen
                $tipoArchivo = $_FILES['foto']['type'];
                $nombreArchivo = $_FILES['foto']['name'];
                // // $tamanoArchivo = $_FILES['foto']['size'];
                // // $temp = $_FILES['foto']['tmp_name'];
                // // $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
                // // $binariosImagen = fread($imagenSubida, $tamanoArchivo);
                // // $binariosImagen2 = mysqli_escape_string($db, $binariosImagen);
                // datos de productos
                $nombre = trim($_POST['nombre']);
                $precio = trim($_POST['precio']);
                $estado = trim($_POST['estado']);
                $visible = trim($_POST['visible']);
                $tprepa = trim($_POST['tprepa']);
                $descripcion = trim($_POST['descripcion']);
                $categoria = trim($_POST['categoria']);

                // archivo
                $filename        = $_FILES['foto']['name'];
                $sourceFoto      = $_FILES['foto']['tmp_name'];


                $logitudPass    = 10;
                $newNameFoto    = substr( md5(microtime()), 1, $logitudPass);

                $explode        = explode('.', $filename);
                $extension_foto = array_pop($explode);
                $nuevoNameFoto  = $newNameFoto.'.'.$extension_foto;

                //Verificando si existe el directorio
                $dirLocal = "Imagenes_Nuevas";
                if (!file_exists($dirLocal)) {
                    mkdir($dirLocal, 0777, true);
                }

                $miDir         = opendir($dirLocal); //Habro el directorio
                $imagenCliente = $dirLocal.'/'.$nuevoNameFoto;

                if(move_uploaded_file($sourceFoto, $imagenCliente)){


                    $consultaagregar = "INSERT INTO producto_menu(nombre_prod_m, precio_prod_m, estado_prod_m, visible_prod_m, tmprepa_prod_m, descrip_prod_m, id_cat_prod_menu, img, nombre_img, tipo_img) 
                                    VALUES ('$nombre', '$precio', '$estado', '$visible', '$tprepa', '$descripcion', '$categoria', '".$imagenCliente."', '$imagenCliente', '$tipoArchivo')";
                    $resultadoaagregar = mysqli_query($conexion,$consultaagregar);
                    if ($resultadoaagregar) {
                        // move_uploaded_file($temp,'img_prod_m/'.$nomb); 
                        $_SESSION['mensaje'] = "Producto guardado";
                        $_SESSION['tipo_mensaje'] = "primary";
                        header("Location: inv-alm-producto.php");
                    } else {
                        $_SESSION['mensaje'] = "¡Ups ha ocurrido un error!";
                        $_SESSION['tipo_mensaje'] = "danger";
                        header("Location: inv-alm-producto.php");
                    }
                }
            }
        }
        else{
            $_SESSION['mensaje'] = "¡Por favor complete los campos!";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: inv-alm-producto.php");
        }
    }
?>