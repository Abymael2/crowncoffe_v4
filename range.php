<?php
	require'db.php';
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conexion, "SELECT * FROM `producto_inventario` WHERE `fecha_producto` BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>

	<tr>
		<td ><?php echo $fetch['nombre_prod_inv']?></td>
		<td><?php echo $fetch['costo_prod_inv']?></td>
		<td><?php echo $fetch['u_elim_prod_inv']?></td>
		<td><?php echo $fetch['fecha_producto']?></td>
	</tr>
<?php
			}
		}else{
			echo'
			<tr>
				<td colspan = "4"><center>Registros no Existen</center></td>
			</tr>';
		}
	}else{
		$query=mysqli_query($conexion, "SELECT * FROM `producto_inventario`") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>

	<tr>
		<td ><?php echo $fetch['nombre_prod_inv']?></td>
		<td><?php echo $fetch['costo_prod_inv']?></td>
		<td><?php echo $fetch['u_elim_prod_inv']?></td>
		<td><?php echo $fetch['fecha_producto']?></td>
	</tr>


<?php
		}
	}
?>
