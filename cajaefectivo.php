<?php
    session_start();
    $varsesion = $_SESSION['usuario']; 
    $hora = date("H:i:s", time());
    include("db.php");
    if(isset($_REQUEST['btnefectivo'])) {
        $dinero = trim ($_POST["txtefectivo"]);
        $consulta="INSERT INTO tbcajaefectivo (efectivo,usuarioinicio,estado,hora_apertura) VALUES ('$dinero','$varsesion',1,'$hora')";
        $resultado2 = mysqli_query($conexion,$consulta);
        
        if ($resultado2){
            $consCajaNueva="SELECT * FROM tbcajaefectivo WHERE estado=1 ";
            $resCajaNueva=mysqli_query($conexion, $consCajaNueva) or die("Problemas en la consulta: ".mysqli_error($conexion));

            if ($rowCajaN=mysqli_fetch_array($resCajaNueva)) {
                $id_caja=$rowCajaN['id'];
                $_SESSION['id_caja']=$id_caja;


                header("Location: inicio.php");
                echo '<script> alert ("Efectivo ingresado correctamente") </script>';
                $_SESSION['caja'] = 1;
            }
        } 
        else{
            echo '<script> alert("Error") </script> ' ;
        }
    }
    

?>