<?php 
    session_start();
    include("db.php");

    if(isset($_POST['reanudar'])) 
    {
        if (strlen($_POST['caja']) >= 1) 
        {
            $idk = trim($_POST['caja']);
            $consultaagregar = "UPDATE tbcajaefectivo SET estado='1' WHERE id = $idk";
            mysqli_query($conexion,$consultaagregar);
            $_SESSION['caja'] = 1;

            $consCajaNueva="SELECT * FROM tbcajaefectivo WHERE estado=1 ";
            $resCajaNueva=mysqli_query($conexion, $consCajaNueva) or die("Problemas en la consulta: ".mysqli_error($conexion));

            if ($rowCajaN=mysqli_fetch_array($resCajaNueva)) {
		        $id_caja=$rowCajaN['id'];
                $_SESSION['id_caja']=$id_caja;
                header("Location: inicio.php");
            }
            
        }
        else{
            $_SESSION['mensaje'] = "¡Por favor complete los campos!";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: inv-alm-categoria.php");
        }
    }
?>