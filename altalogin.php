
<?php
    /*$dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "crowncoffe";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    if(!$conn){
        die("no hay conexion".mysqli_connect_error());
    }

    $nombre = $_POST["user"];
    $pass = $_POST["pass"];

    $query = mysqli_query($conn,"SELECT * FROM usuarios WHERE nombre ='".$nombre."' and contraseña ='".$pass."'");
    $nr = mysqli_num_rows($query);

    if($nr == 1){
        session_start();
        $_SESSION['usuario'] = $nombre;
        header("Location: inicio.php");
    }else if($nr == 0){
        header("Location: index.php");
    }*/

    $usuario=$_REQUEST['user'];
	$clave=$_REQUEST['pass'];
	$consulta="SELECT * FROM usuarios WHERE nombre='$usuario' AND contraseña='$clave'";
    $consulta2="SELECT * FROM tbcajaefectivo WHERE estado=1 ";

	$conexion=mysqli_connect("localhost","root","","crowncoffe") or die("Problemas con la conexión");

	$registro=mysqli_query($conexion, $consulta) or die("Problemas en la consulta: ".mysqli_error($conexion));
    $registro2=mysqli_query($conexion, $consulta2) or die("Problemas en la consulta: ".mysqli_error($conexion));

    if ($datos2=mysqli_fetch_array($registro2)) {
		$idga=$datos2['id'];
		$efectivoga=$datos2['efectivo'];
		$usuarioI=$datos2['usuarioinicio'];
		$usuarioF=$datos2['usuariofin'];
        $estado=$datos2['estado'];
		}
		
	if ($datos=mysqli_fetch_array($registro)) {
		$id=$datos['id_usuario'];
		$nombre=$datos['nombre'];
		$clave_db=$datos['contraseña'];
		$tipo=$datos['permiso'];
		if (($usuario==$nombre) && ($clave==$clave_db)) {
                    session_start();
                    $_SESSION['iduser'] = $id;
                    $_SESSION['id_caja']=$idga;
                    $_SESSION['usuario'] = $nombre;
                    $_SESSION['permiso'] = $tipo;
                    $_SESSION['carrito'] = null; //carrito de compras
                    if($estado == 1){
                        header("Location: inicio.php");
                    }else{
                        header("Location: abrircaja.php");
                    }
					
			}
			else {
				header("Location: index.php");
			}
		}
		else {
			header ("Location: index.php");
		}

        //================
            



	  // else {
		//header("Location: error.php");
	//}
	mysqli_close($conexion);


?>

<?php $_SESSION['no_prod_orden'] = NULL?>

  

