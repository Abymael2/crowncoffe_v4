    <!-- Ventana modal para ver detalle orden -->
    <div class="modal fade text-dark" id="modal_editar<?php echo $row["id_det_orden"];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalle de orden</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">No. de orden: <b class="fs-5">#<?php echo $row["id_det_orden"];?></b></label>
            </div>
            <div class="mb-3 text-break">
                <ul class="list-group mb-8">
                    <li class="list-group-item d-flex justify-content-between lh-condensed bg-primary">
                        <div class="row col-12 text-center fw-bold">
                            <div class="col-2 p-0">
                                Numero de mesa
                            </div>
                            <div class="col-2 p-0">
                                Fecha
                            </div>
                            <div class="col-2 p-0">
                                Cantidad
                            </div>
                            <div class="col-2 p-0">
                                Precio
                            </div>
                            <div class="col-2 p-0">
                                Producto
                            </div>
                            <div class="col-2 p-0">
                                Accion
                            </div>
                        </div>
                    </li>
                    <?php
                            $detor = $row["id_det_orden"];
                            $detalleorden = "SELECT tmo.id_orden, m.numero, dto.fecha, tmo.cantidad, tmo.precio, tmo.nombre_prod_m
                            FROM toma_orden AS tmo
                                INNER JOIN detalle_orden AS dto ON tmo.id_det_orden = dto.id_det_orden
                                INNER JOIN mesa AS m ON dto.id_mesa = m.id_mesa
                            WHERE dto.id_det_orden = '$detor'"; //$row["id_det_orden"]
                            $resdetord = mysqli_query($conexion, $detalleorden);

                            while($roworden=mysqli_fetch_assoc($resdetord)){
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed bg-faded">
                            <div class="row col-12 text-center">
                                <div class="col-2 p-0">
                                    <?php echo $roworden["numero"] ?>
                                </div>
                                <div class="col-2 p-0">
                                    <?php echo $roworden["fecha"] ?>
                                </div>
                                <div class="col-2 p-0">
                                    <?php echo $roworden["cantidad"] ?>
                                </div>
                                <div class="col-2 p-0">
                                    <?php echo $roworden["precio"] ?>
                                </div>
                                <div class="col-2 p-0">
                                    <?php echo $roworden["nombre_prod_m"] ?>
                                </div>
                                <div class="col-2 p-0">
                                    <a class="btn btn-outline-warning text-dark" href="ver_det_ord_elim.php?idor=<?php echo $roworden["id_orden"] ?>">
                                    <img class="d-inline" src="img/x.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </li>

                        <?php
                            }
                        ?>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <a type="button" class="btn btn-primary" href="v_agreg_prod.php?id_det_orden=<?php echo $row["id_det_orden"] ?>">Agregar producto</a>
            <a type="button" href="v_facturar_orden.php?id_det_orden=<?php echo $row["id_det_orden"] ?>" class="btn btn-primary" >Facturar</a> 
            
        </div>
        </div>
    </div>
</div>

    <!-- FIN MODAL -->