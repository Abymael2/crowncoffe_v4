<!-- Modal detalle de compra-->
<div class="modal fade text-secondary" id="modal_detalle_gasto<?php echo $row["id"]; ?>" tabindex="-1"role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalle de Gasto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=".php" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Gasto # <?php echo $row["id"]; ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripcion:</label>
                        <input class="form-control" type="text" name="descripcion" disabled value="<?php echo $row["Descripcion"] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Total:</label>
                        <input class="form-control" type="text" name="total" disabled value="Q <?php echo $row["cantidad"] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="guardar_cat" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal detalle de compra-->
<div class="modal fade text-secondary" id="modal_detalle_compra<?php echo $rowdc["id_compra"]; ?>" tabindex="-1"role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalle de Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=".php" method="post" id="form-cat">
                    <?php
                        $id_compra = $rowdc["id_compra"];
                        $consDetOrd = "SELECT pin.nombre_prod_inv, cp.cantidad, cp.costo FROM `compra_producto` AS cp 
                        INNER JOIN producto_inventario AS pin ON pin.id_producto_inv = cp.id_producto_inv
                        WHERE cp.id_compra = '$id_compra';";
                        $resDetOrd = mysqli_query($conexion, $consDetOrd);
                        $rowDetOrd = mysqli_fetch_assoc($resDetOrd);
                    ?>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Compra # <?php echo $rowDetOrd["nombre_prod_inv"]; ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">cantidad = <?php echo $rowDetOrd["cantidad"]; ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">costo = <?php echo $rowDetOrd["costo"]; ?></label>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Total:</label>
                        <input class="form-control" type="text" name="total" disabled value="Q <?php echo $rowDetOrd["costo"]*$rowDetOrd["cantidad"] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="guardar_cat" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal detalle de orden-->
<div class="modal fade text-secondary" id="modal_detalle_venta<?php echo $rowf["id_factura"]; ?>" tabindex="-1"role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detalle de Venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=".php" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Factura # <?php echo $rowf["id_factura"]; ?></label>
                    </div>
                    <!-- INICIO TABLA DETALLE -->
                    <div class="mb-3 text-break">
                        <ul class="list-group mb-8">
                            <li class="list-group-item d-flex justify-content-between lh-condensed bg-primary">
                                <div class="row col-12 text-center fw-bold">
                                    <div class="col-3 p-0">
                                        Producto
                                    </div>
                                    <div class="col-3 p-0">
                                        Cantidad
                                    </div>
                                    <div class="col-3 p-0">
                                        Precio
                                    </div>
                                    <div class="col-3 p-0">
                                        Total
                                    </div>
                                </div>
                            </li>
                            <?php
                                $id_factura = $rowf["id_factura"];
                                $sumaDetOrd = 0;
                                $detalleorden = "SELECT tor.nombre_prod_m, tor.cantidad, tor.precio, (tor.cantidad*tor.precio) AS total
                                FROM factura AS f
                                INNER JOIN detalle_orden AS dor ON dor.id_det_orden = f.id_detalle_orden
                                INNER JOIN toma_orden AS tor ON tor.id_det_orden = dor.id_det_orden
                                WHERE f.id_factura = '$id_factura';"; //$row["id_det_orden"]
                                $resdetord = mysqli_query($conexion, $detalleorden);
    
                                while($roworden=mysqli_fetch_assoc($resdetord)){
                                    $sumaDetOrd = $sumaDetOrd + $roworden["total"];
                                ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed bg-faded">
                                    <div class="row col-12 text-center">
                                        <div class="col-3 p-0">
                                            <?php echo $roworden["nombre_prod_m"] ?>
                                        </div>
                                        <div class="col-3 p-0">
                                            <?php echo $roworden["cantidad"] ?>
                                        </div>
                                        <div class="col-3 p-0">
                                            <?php echo $roworden["precio"] ?>
                                        </div>
                                        <div class="col-3 p-0">
                                            <?php echo $roworden["total"] ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                    }
                                ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed bg-faded">
                                    <div class="row col-12 text-center">
                                        <div class="col-3 p-0">
                                            <?php //echo $roworden["nombre_prod_m"] ?>
                                        </div>
                                        <div class="col-3 p-0">
                                            <?php //echo $roworden["cantidad"] ?>
                                        </div>
                                        <div class="col-3 p-0">
                                            TOTAL
                                        </div>
                                        <div class="col-3 p-0">
                                            <?php echo $sumaDetOrd ?>
                                        </div>
                                    </div>
                                </li>
                        </ul>
                    </div>
                    <!-- FIN TABLA DETALLE  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="guardar_cat" value="aaa">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>