<?php 
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>
<!-- navegacion -->
<?php include("includes/nav.php"); ?>
        
<!-- alerta de agregar categoria -->
<div class="container">
<?php if(isset($_SESSION['mensaje'])){  ?>
        <div class="alert bg-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['mensaje']); 
            unset($_SESSION['tipo_mensaje']); 
    } ?>
</div>
    <!--agregar-->
    <div class="container-fluid px-4 py-2 text-center">
        <h2 class="text-light">Categoría de producto menú</h2>
        <button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal_agregar"> <i class='bx bx-plus-medical'></i> AGREGAR </button>
    </div>

    <!-- tabla de datos -->
    <div class="container-fluid p-4 table-responsive-lg text-primary">
        <table class="table table-striped text-center" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $categoria = "SELECT * FROM categoria_prod_menu";
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row["id_cat_prod_menu"] ?></th>
                    <td><?php echo $row["nombre_cat"] ?></td>
                    <td><?php echo $row["descripcion_cat"] ?></td>
                    <td> 
                        <a class="btn btn-outline-warning m-1" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_cat_prod_menu"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/pencil-square.svg" alt="">
                        </a> 
                        <a class="btn btn-outline-danger m-1" href="" data-bs-toggle="modal" data-bs-target="#modal_eliminar<?php echo $row["id_cat_prod_menu"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-inline" src="img/trash.svg" alt="">
                        </a> 
                    </td>
                </tr>

                <?php 
                    include("inv-alm-categoria-eliminar.php"); 
                    include("inv-alm-categoria-edit.php"); 
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
<div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar categoría a productos menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-categoria-nuevo.php" method="post" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre categoría:</label>
                        <input class="form-control" type="text" name="nombre" >
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripción:</label>
                        <input class="form-control" type="text" name="descripcion" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" name="guardar_cat" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <?php include("includes/footer.php"); ?>
