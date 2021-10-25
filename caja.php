<?php 
    session_start();
    $varsesion = $_SESSION['usuario'];
    error_reporting(0);
    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }

   

    include("db.php");
    
    //$gastos = "SELECT tbgatsos.*, FROM caja_gasto INNER JOIN  ";

    $consulta2="SELECT * FROM tbcajaefectivo WHERE estado=1 ";
    $registro2=mysqli_query($conexion, $consulta2) or die("Problemas en la consulta: ".mysqli_error($conexion));

    if ($datos2=mysqli_fetch_array($registro2)) {
		$idcaja=$datos2['id'];
		$efectivoga=$datos2['efectivo'];
		$usuarioI=$datos2['usuarioinicio'];
		$usuarioF=$datos2['usuariofin'];
        $estado=$datos2['estado'];
		}

    //$gastos = "SELECT * FROM tbgastos";
    $gastos = "SELECT tbgastos.cantidad, tbgastos.Descripcion, caja_gasto.id FROM caja_gasto 
    INNER JOIN tbgastos ON tbgastos.id = caja_gasto.id_gasto 
    INNER JOIN tbcajaefectivo ON tbcajaefectivo.id = caja_gasto.id_caja 
    WHERE caja_gasto.id_caja = $idcaja";

        //obntener las facturas con el id de caja activo
    $factura = "SELECT * FROM factura AS f
    INNER JOIN tbcajaefectivo AS tbc ON tbc.id = f.id_caja 
    WHERE f.id_caja = $idcaja";

        //obntener las detalle_compra con el id de caja activo
    $detalle_compra = "SELECT * FROM detalle_compra AS dc
    INNER JOIN tbcajaefectivo AS tbc ON tbc.id = dc.id_caja 
    WHERE dc.id_caja = $idcaja";

?>

<?php 
 //date_default_timezone_set('America/Guatemala_City');
 //$fecha_actual=date("y-m-d h:i:s UTC")?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cafeteria</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <body>
        <header>
            <h1 class="site text-center text-faded d-none d-lg-block">
                <span class="site-heading-upper text-primary mb-3">Cafeteria</span>
                <span class="site-heading-lower">Crown Coffee</span>
            </h1>
        </header>
        <!-- Navigation-->
        <?php 
            if($_SESSION['permiso']== 'Administrador'){
                include 'headerAdmin.php';
            }else{
                include 'headerAux.php';
            }
            
        ?>
    <div class="container text-center text-white">
        <h1>Caja</h1>
    </div>

    <div class="container text-primary">
        <div class="row">
            <div class="col-6 p-2">
                <label for="formGroupExampleInput" class="form-label ">Fecha y Hora</label>
                <input name = "fecha" type="datetime" class="form-control" id="fecha" value ="<?php echo date("Y-m-d H:i:s", time()); ?>" disabled>
            </div>
            <div class="col-6 p-2">
                <label for="formGroupExampleInput" class="form-label ">Efectivo Inicial</label>
                <input name = "efectivo" type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $efectivoga?>" disabled>
            </div>
            <div class="col-6 p-2">
                <label for="formGroupExampleInput" class="form-label ">Autorizacion Para el Cierre</label>
                <input name = "user" type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $_SESSION['permiso']?>" disabled>
            </div>
            <div class="col-6 p-2">
                <form class="login-form" action="altacerrarcaja.php" method="post">
                    <button class="btn btn-outline-primary btn-md" type="submit" >Cerrar Caja</button>
                </form>
            </div>
        </div>
    </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Gastos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" name="nombre">Cantidad</label>
                                <input class="form-control" type="number" name="cantidad" >
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" name="contraseña">Descripcion</label>
                                <input class="form-control" type="text" name="Descripcion" >
                            </div>
                            
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label" hidden name="contraseña">Tipo de Transacción</label>
                                <input class="form-control" type="text" name="TipoTransaccion" hidden value="gasto">
                            </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input class="btn btn-primary" type="submit" name="btnguardargast" >
                            <?php 
                            include("registrargasto.php"); 
                            ?>
                        </div>
                        </form>
                </div>
            </div>
        </div>


            <!-- TABLA PRINCIPAL DE ORDEN-->
        <div class="container-fluid px-5 table-responsive-lg text-primary">
            <table class="table table-striped" id="datatable_footer"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">Tipo de Transacción</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">No.</th>
                    <th scope="col">Total</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">

            <!-- Efectivo inicial -->
            <?php 
                    $cons_efectivo = "SELECT * FROM tbcajaefectivo WHERE estado=1;";
                    $resefec = mysqli_query($conexion, $cons_efectivo);
                    while($rowefec=mysqli_fetch_assoc($resefec)){
                ?>
                <tr>
                <td >efectivo</td>
                    <td>Efectivo</td>
                    <td>....</td>
                    <td><?php echo $rowefec["efectivo"] ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_detalle_gasto<?php echo $row["id"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/lista.svg" alt="">
                        </a>
                    </td>
                </tr>
                <?php 
                //include("caja_verDetalle.php"); 
                    }
                ?>

            <!-- Gastos -->
            <?php 
                    $resultado = mysqli_query($conexion, $gastos);
                    while($row=mysqli_fetch_assoc($resultado)){
                        $gastoTotal = $gastoTotal + $row["cantidad"];
                ?>
                <tr>
                <td >Gasto</td>
                    <td><?php echo $row["Descripcion"] ?></td>
                    <td><?php echo $row["id"] ?></td>
                    <td>-<?php echo $row["cantidad"] ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_detalle_gasto<?php echo $row["id"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/lista.svg" alt="">
                        </a>
                    </td>
                </tr>
                <?php 
                include("caja_verDetalle.php"); 
                    }
                ?>

                    <!-- ventas -->
            <?php 
                    $resfactura = mysqli_query($conexion, $factura);
                    while($rowf=mysqli_fetch_assoc($resfactura)){
                        $idfactura = $rowf["id_factura"];
                        //calcular total de cada factura
                        $consOrdTotal = "SELECT SUM(tor.precio*tor.cantidad) AS total FROM `factura` AS f
                        INNER JOIN detalle_orden As do ON f.id_detalle_orden = do.id_det_orden
                        INNER JOIN toma_orden AS tor ON do.id_det_orden = tor.id_det_orden
                        WHERE f.id_factura = '$idfactura';";
                        $resOrdTotal = mysqli_query($conexion, $consOrdTotal);
                        $rowOrdTotal = mysqli_fetch_assoc($resOrdTotal);
                        $ventaTotal = $ventaTotal + $rowOrdTotal["total"];

                ?>
                <tr>
                    <td >Venta</td>
                    <td>Factura</td>
                    <td><?php echo $idfactura ?></td>
                    <td><?php echo $rowOrdTotal["total"] ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_detalle_venta<?php echo $rowf["id_factura"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/lista.svg" alt="">
                        </a>
                    </td>
                </tr>
                <?php 
                include("caja_verDetalle.php"); 
                    }
                ?>

                    <!-- compras -->
            <?php 
                    $resDetCompra = mysqli_query($conexion, $detalle_compra);
                    while($rowdc=mysqli_fetch_assoc($resDetCompra)){
                        $id_compra = $rowdc["id_compra"];
                        //calcular total de cada factura
                        $consDetOrdTotal = "SELECT (cp.costo*cp.cantidad) AS total FROM `detalle_compra` AS dc
                        INNER JOIN compra_producto As cp ON cp.id_compra = dc.id_compra
                        WHERE dc.id_compra = '$id_compra';";
                        $resDetOrdTotal = mysqli_query($conexion, $consDetOrdTotal);
                        
                        //$compraTotal = $compraTotal + $rowDetOrdTotal["total"];

                ?>
                <tr>
                    <td >Compra</td>
                    <td>Compra</td>
                    <td><?php echo $id_compra ?></td>
                    <td><?php $rowDetOrdTotal = mysqli_fetch_assoc($resDetOrdTotal);
                    echo -$rowDetOrdTotal["total"]; 
                    ?></td>
                    <td>
                        <a class="btn btn-outline-warning" href="" data-bs-toggle="modal" data-bs-target="#modal_detalle_compra<?php echo $rowdc["id_compra"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/lista.svg" alt="">
                        </a>
                    </td>
                </tr>
                <?php 
                include("caja_verDetalle.php"); 
                    }
                ?>

                <!-- <tr>
                    <td></td>
                    <td></td>
                    <td class="bg-primary fw-bold text-end">TOTAl</td>
                    <!-- suma de gastos y ventas -->
                    <!-- <td class="bg-primary fw-bold text-center"></td> -->
                    <!-- Q <?php //echo $ventaTotal + $gastoTotal ?> -->
                    <!-- <td></td> -->
                <!-- </tr> -->
            </tbody>
            <tfoot class="bg-primary">
                <tr>
                    <td ></td>
                    <td ></td>
                    <td class="fw-bold text-end">TOTAL</td>                    
                    <td ></td>
                    <td ></td>
                </tr>
            </tfoot>
            </table>
        
        </div>
        <br>
        <div class="container text-center">
            <button name="agregar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Agregar Gastos</button>
        </div>

        <!-- datatable -->
        <script src="./js/datatable_footer.js"></script>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php include("includes/footer.php"); ?>
