<?php session_start(); 
//aqui empieza el carrito

	if(isset($_SESSION['carrito'])){
		$carrito_mio=$_SESSION['carrito'];
		if(isset($_POST['cantida'])){
			$idprodm=$_POST['idprodm'];
			$nomprodm=$_POST['nomprodm'];
			$mesa=$_POST['mesa'];
			// $noprodord=$_POST['noprodord'];
			$precio=$_POST['precio'];
			$cantida=$_POST['cantida'];
			$num=0;
            $carrito_mio[]=array("idprodm"=>$idprodm,"nomprodm"=>$nomprodm,"mesa"=>$mesa,"cantida"=>$cantida,"precio"=>$precio);
        }
	}else{
		$idprodm=$_POST['idprodm'];
        $nomprodm=$_POST['nomprodm'];
        $mesa=$_POST['mesa'];
        $noprodord=$_POST['noprodord'];
        $precio=$_POST['precio'];
        $cantida=$_POST['cantida'];
		$carrito_mio[]=array("idprodm"=>$idprodm,"nomprodm"=>$nomprodm,"mesa"=>$mesa, "cantida"=>$cantida,"precio"=>$precio);	
	}
	

$_SESSION['carrito']=$carrito_mio;

//aqui termina el carrito
$id_det_orden = $_SESSION['id_det_orden'];
$pag = 'v_agreg_prod.php?id_det_orden='.$id_det_orden;

header("Location: {$pag}");
?>

