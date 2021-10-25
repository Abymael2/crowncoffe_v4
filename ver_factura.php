<?php 
    session_start();
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>


<!-- tabla de datos -->
    <div class="container-sm text-primary table-responsive">
        <h1 class="site text-center text-faded m-2">
            <span class="site-heading-upper text-primary mb-3">Cafeteria</span>
            <span class="site-heading-lower">Crown Coffee</span>
        </h1>
        <h1>
            Facturación
        </h1>
    <!--Buscar y agregar-->
        <table class="table table-striped" id="datatable_footer"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php
                    
                        $id_det_orden = $_SESSION['id_det_orden'];
                        $detalleorden = "SELECT tmo.id_orden, m.numero, dto.fecha, tmo.cantidad, tmo.precio, tmo.nombre_prod_m
                        FROM toma_orden AS tmo
                            INNER JOIN detalle_orden AS dto ON tmo.id_det_orden = dto.id_det_orden
                            INNER JOIN mesa AS m ON dto.id_mesa = m.id_mesa
                        WHERE dto.id_det_orden = '$id_det_orden'"; //$row["id_det_orden"]
                        $resdetord = mysqli_query($conexion, $detalleorden);

                        while($roworden=mysqli_fetch_assoc($resdetord)){ 
                            ?>
                            <tr>
                                <td><?php echo $roworden["nombre_prod_m"] ?></td>
                                <td><?php echo $roworden["cantidad"] ?></td>
                                <td><?php echo $roworden["precio"] ?></td>
                                <td><?php echo $roworden["precio"] * $roworden["cantidad"] ?></td>
                            </tr>
                        <?php
                        }
                    
                ?>
            </tbody>
            <tfoot class="bg-primary">
                <tr>
                    <td ></td>
                    <td ></td>
                    <td class="fw-bold text-end">TOTAL</td>                    
                    <td ></td>
                </tr>
            </tfoot>
        </table>
        <div class="container text-center p-3">
            <a href="verOrden.php" class="btn btn-primary p-3 fw-bold fs-3">Cerrar</a>
        </div>
    </div>

<?php include("includes/footer.php"); ?>