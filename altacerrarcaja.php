<?php  
    session_start();
    $varsesion = $_SESSION['usuario'];
    include("db.php");

    $consulta2="SELECT * FROM tbcajaefectivo WHERE estado=1 ";
    $registro2=mysqli_query($conexion, $consulta2) or die("Problemas en la consulta: ".mysqli_error($conexion));

    if ($datos2=mysqli_fetch_array($registro2)) {
		$idga=$datos2['id'];
		$efectivoga=$datos2['efectivo'];
		$usuarioI=$datos2['usuarioinicio'];
		$usuarioF=$datos2['usuariofin'];
        $estado=$datos2['estado'];
	}


    $fecha = date("Y-m-d", time());
    $hora = date("H:i:s", time());
    $user = isset($_POST["user"]);
    echo $fecha;
    $consultaagregar = "UPDATE tbcajaefectivo SET efectivo = '$efectivoga', usuarioinicio = '$usuarioI', usuariofin = '$varsesion', fecha='$fecha',estado='0', hora_cierre = '$hora' 
                            WHERE estado = 1";
    mysqli_query($conexion,$consultaagregar);
    session_destroy();
    header ("Location: index.php");

?>