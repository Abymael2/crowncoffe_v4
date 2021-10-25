<?php 
    $carrito_mio=$_SESSION['carrito'];
    $_SESSION['carrito']=$carrito_mio;
?>

<!-- Modal -->
<div class="modal fade" id="modal_orden<?php echo $row["id_producto_m"];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto a la Orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="toma_orden_detalle.php" method="post" id="form-cat">
                    <?php 
                        $prod = "SELECT * FROM producto_menu WHERE id_producto_m = '".$row["id_producto_m"]."'";
                        $res_prod = mysqli_query($conexion, $prod);
                        while($row2=mysqli_fetch_assoc($res_prod)){
                    ?>
                    <div class="mb-3">
                        <h4 class="text-center"><?php echo $row2["nombre_prod_m"] ?></h4>
                        <p class="text-center"><?php echo $row2["descrip_prod_m"] ?></p>
                        <p class="text-center fs-3">Precio:<b> Q <?php echo $row2["precio_prod_m"] ?></b></p>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Cantidad:</label>
                        <input class="form-control" type="text" name="idprodm" value="<?php echo $row2["id_producto_m"] ?>" hidden>
                        <input class="form-control" type="text" name="nomprodm" value="<?php echo $row2["nombre_prod_m"] ?>" hidden>
                        <input class="form-control" type="text" name="mesa" value="<?php echo $_SESSION['numero_m'] ?>" hidden>
                        <input class="form-control" type="text" name="precio" value="<?php echo $row2["precio_prod_m"] ?>" hidden>
                        <!-- <input class="form-control" type="text" name="noprodord" value="<?php //echo $_SESSION['no_prod_orden'];?>" > -->
                        <input class="form-control" type="number" name="cantida" autofocus pattern="\d+" step="1" min="1" required>
                    </div>
                    <?php 
                        }
                    ?>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" name="btnorden" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
    if(isset($_POST["btnorden"])){
        $fila=$_POST["fila"];
    }
?>


<!-- MODAL CARRITO -->
<div class="modal fade" id="modal_cart" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalle orden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
        <h4> Mesa <?php echo $_SESSION['numero_m']?> </h4>
			<div class="modal-body">
				<div>
					<div class="p-1">
						<ul class="list-group mb-8">
							<?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
							if($carrito_mio[$i]!=NULL){
						?>

							<li class="list-group-item d-flex justify-content-between lh-condensed">
								<div class="row col-12" >
									<div class="col-7 p-0" style="text-align: left; color: #000000;"><h6 class="my-0"><?php echo $carrito_mio[$i]['cantida'] ?> : <?php echo $carrito_mio[$i]['nomprodm']; ?></h6>
									</div>
									<div class="col-3 p-0"  style="text-align: right; color: #000000;" >
									<span   style="text-align: right; color: #000000;">Q <?php echo $carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantida'];    ?> </span>
									</div>
									<div class="col-2 p-0 bg-"  style="text-align: right;" > 
                                        <a class="btn btn-outline-danger " href="toma_orden_elim_prod.php?cad=<?php echo $i?>">
                                            <img class="d-inline" src="img/x.svg" alt="">
                                        </a> 
									</div>
								</div>
							</li>
							<?php
                            $total11 = $carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantida'];
							$total=$total + $total11;
							}
							}
							}
							?>
							<li class="list-group-item d-flex justify-content-between">
							<span  style="text-align: left; color: #000000;">Total (Q)</span>
							<strong  style="text-align: left; color: #000000;">Q <?php
							if(isset($_SESSION['carrito'])){
							$total=0;
							for($i=0;$i<=count($carrito_mio)-1;$i ++){
							if($carrito_mio[$i]!=NULL){ 
							$total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantida']);
							}
                            }
                            if($total!=NULL){ echo $total;}
                            else{ echo $total = 0; }

                            }
							?> </strong>
							</li>
						</ul>
					</div>
				</div>
			</div>
			


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <a type="button" class="btn btn-primary" href="toma_orden_elim.php">Guardar orden</a>
        </div>
        </div>
    </div>
    </div>
<!-- END MODAL CARRITO -->

