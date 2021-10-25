<?php
include("db.php");

$id = $_GET['id'];
$eliminar="DELETE FROM orden WHERE Id_orden ='$id'";

$resultadoEliminar = mysqli_query($conexion, $eliminar);

if($resultadoEliminar){
    header("Location: verOrden.php");
}else{
    echo"<script>alert('No se pudo eliminar'); window.history.go(-1);</script>";
}