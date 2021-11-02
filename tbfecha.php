<?php 
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>
<!-- navegacion -->
<?php include("includes/nav.php"); ?>
        
<!-- alerta de agregar categoria -->
<div class="container-fluid">
<?php if(isset($_SESSION['mensaje'])){  ?>
        <div class="alert bg-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['mensaje']); 
            unset($_SESSION['tipo_mensaje']); 
    } ?>
</div>
<div class="container text-center text-white">
        <h1>Reporte de cajas</h1>
    </div>
    <!-- tabla de datos -->
    <div class="container-fluid px-5 table-responsive-lg text-primary">
        <table class="table table-striped" id="datatable_footer1"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">Efectivo Inicial</th>
                    <th scope="col">Apertura</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Cierre</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total de caja</th>
					<th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $detalleorden = "SELECT * FROM tbcajaefectivo";
                    $resultado = mysqli_query($conexion, $detalleorden);
                    while($row=mysqli_fetch_assoc($resultado)){

                ?>
                <tr>
					<?php $vax = $row["id"]?>
                    <td scope="row">Q <?php echo $sum = $row["efectivo"] ?></td>
                    <td><?php echo $row["usuarioinicio"] ?></td>
                    <td><?php echo $row["hora_apertura"] ?></td>
                    <td><?php echo $row["usuariofin"];?></td>
                    <td><?php echo $row["hora_cierre"] ?></td>
					<td><?php echo $row["fecha"] ?></td>
                    <?php 
                    //resta de todos los gastos
                    $gastos = "SELECT SUM(tbgastos.cantidad) as total FROM caja_gasto 
                    INNER JOIN tbgastos ON tbgastos.id = caja_gasto.id_gasto 
                    INNER JOIN tbcajaefectivo ON tbcajaefectivo.id = caja_gasto.id_caja 
                    WHERE caja_gasto.id_caja = $vax";
                    $gst = mysqli_query($conexion, $gastos);
                    $rog = mysqli_fetch_assoc($gst);
                    $tot = $rog["total"];
                    //suma de ventas
                    $factura = "SELECT * FROM factura AS f
                    INNER JOIN tbcajaefectivo AS tbc ON tbc.id = f.id_caja 
                    WHERE f.id_caja = $vax";
                    $resfactura = mysqli_query($conexion, $factura);
                    while($rowf=mysqli_fetch_assoc($resfactura)){
                        $idfactura = $rowf["id_factura"];
                        $consOrdTotal = "SELECT SUM(tor.precio*tor.cantidad) AS total2 FROM `factura` AS f
                        INNER JOIN detalle_orden As do ON f.id_detalle_orden = do.id_det_orden
                        INNER JOIN toma_orden AS tor ON do.id_det_orden = tor.id_det_orden
                        WHERE f.id_factura = '$idfactura';";
                        $resOrdTotal = mysqli_query($conexion, $consOrdTotal);
                        $rowOrdTotal = mysqli_fetch_assoc($resOrdTotal);
                        $sum = $sum + $rowOrdTotal["total2"];
                    }
                    //resta de compras
                    $detalle_compra = "SELECT * FROM detalle_compra AS dc
                    INNER JOIN tbcajaefectivo AS tbc ON tbc.id = dc.id_caja 
                    WHERE dc.id_caja = $vax";
                    $resDetCompra = mysqli_query($conexion, $detalle_compra);
                    while($rowdc=mysqli_fetch_assoc($resDetCompra)){
                        $id_compra = $rowdc["id_compra"];
                        $consDetOrdTotal = "SELECT (cp.costo*cp.cantidad) AS total FROM `detalle_compra` AS dc
                        INNER JOIN compra_producto As cp ON cp.id_compra = dc.id_compra
                        WHERE dc.id_compra = '$id_compra';";
                        $resDetOrdTotal = mysqli_query($conexion, $consDetOrdTotal);
                        $rowDetOrdTotal = mysqli_fetch_assoc($resDetOrdTotal);
                        $tot=$tot+$rowDetOrdTotal["total"]; 
                    }
                    ?>
                    <td><?php echo $sum-$tot; ?></td>
                    <td> 
                        <a class="btn btn-outline-warning text-dark" href="ver_detalle_caja.php?var=<?php echo $vax?>">
                            <i class='bx bx-book-open' href="ver_detalle_caja.php"></i>
                        </a>
                    </td>
                </tr>

                <?php 
                    
                    }
                ?>
            </tbody>
            <tfoot class="bg-primary">
                <tr>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td class="fw-bold text-end">TOTAL</td>                    
                    <td ></td>
                    <td ></td>
                </tr>
            </tfoot>
        </table>
    </div>
        <!-- datatable -->
        <script src="./js/sumar_tabla.js"></script>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    <?php include("includes/footer.php"); ?>