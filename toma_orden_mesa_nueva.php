<?php 
    session_start();
    include("db.php");

    if(isset($_POST['btnagregar'])) 
    {
        if (strlen($_POST['numero']) >= 1) 
        {
            $numero = trim($_POST['numero']);

            $mesa = "SELECT * FROM mesa ORDER BY numero";
            $resultado = mysqli_query($conexion,$mesa);
            $repe = 0;
            while($row=mysqli_fetch_assoc($resultado)){
                $num_mesa = $row["numero"];
                if($num_mesa == $numero){
                    $repe = 1;
                }
                else{
                    $_SESSION['mensaje'] = "¡Ups ha ocurrido un error! Numero de mesa existente";
                    $_SESSION['tipo_mensaje'] = "danger";
                    header("Location: tomaOrden.php");
                }
            }

            if($repe == 0){
                $consultaagregar = "INSERT INTO mesa(numero) 
                    VALUES ('$numero')";
                $resultadoaagregar = mysqli_query($conexion,$consultaagregar);
                if ($resultadoaagregar) {
                    // move_uploaded_file($temp,'img_prod_m/'.$nomb); 
                    $_SESSION['mensaje'] = "Se ha añadido una nueva mesa";
                    $_SESSION['tipo_mensaje'] = "primary";
                    header("Location: tomaOrden.php");
                } else {
                    $_SESSION['mensaje'] = "¡Ups ha ocurrido un error!";
                    $_SESSION['tipo_mensaje'] = "danger";
                    header("Location: tomaOrden.php");
                }
            }
            else{
                $_SESSION['mensaje'] = "¡Ups ha ocurrido un error! Numero de mesa existente";
                $_SESSION['tipo_mensaje'] = "danger";
                header("Location: tomaOrden.php");
            }
            

        }
        else{
            $_SESSION['mensaje'] = "¡Por favor complete los campos!";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: tomaOrden.php");
        }
    }
?>

