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
    <!-- tabla de datos -->
    <div class="table-responsive-lg container text-primary">
        <table class="table table-striped text-center align-middle" id="datatable_sn_btn"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">No. de orden</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Observación</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Numero de mesa</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $detalleorden = "SELECT do1.id_det_orden, do1.fecha, do1.observacion, do1.estado_orden, m.numero 
                    FROM detalle_orden AS do1
                    INNER JOIN mesa AS m
                    ON do1.id_mesa = m.id_mesa
                    WHERE do1.estado_orden = 1";
                    $resultado = mysqli_query($conexion, $detalleorden);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"># <?php echo $row["id_det_orden"] ?></th>
                    <td><?php echo $row["fecha"] ?></td>
                    <td><?php echo $row["observacion"] ?></td>
                    <td><?php 
                        if($row["estado_orden"] = 1){
                            echo "Activo";
                        }
                        ?>
                    </td>
                    <td><?php echo $row["numero"] ?></td>
                    <td> 
                        <a class="btn btn-outline-warning text-dark" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_det_orden"]; ?>">
                            <i class='bx bx-book-open'></i>
                        </a>
                        <a class="btn btn-outline-danger text-dark" href="" data-bs-toggle="modal" data-bs-target="#modal_eliminar<?php echo $row["id_det_orden"]; ?>">
                            <img class="d-inline" src="img/trash.svg" alt="">
                        </a>
                    </td>
                </tr>

                <?php 
                    include("ver_detalle_orden.php");
                    include("v_eliminar_orden.php");
                    }
                ?>
            </tbody>
        </table>
    </div>

    <?php include("includes/footer.php"); ?>
