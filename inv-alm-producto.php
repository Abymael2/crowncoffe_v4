<?php 
    include("db.php");
?>


<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>
<!-- navegacion -->
<?php include("includes/nav.php"); ?>
        
<!-- alerta de agregar producto -->
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
        <h2 class="text-light">Productos Menu</h2>
        <button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal_agregar"> <i class='bx bx-plus-medical'></i> AGREGAR </button>
    </div>
    <!-- tabla de datos -->
    <div class="container-fluid px-5 table-responsive-lg text-primary">
        <table class="table table-striped compact" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Visible</th>
                    <th scope="col">Tiempo Preparacion</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $categoria = "SELECT * FROM producto_menu";
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr>
                    <th scope="row"><?php echo $row["id_producto_m"] ?></th>
                    <td><?php echo $row["nombre_prod_m"] ?></td>
                    <td><?php echo $row["precio_prod_m"] ?></td>
                    <td><?php 
                        if($row["estado_prod_m"] == 1){
                            echo 'Activo';
                        }else{
                            echo 'Deshabilitado';
                        }
                        ?></td>
                    <td><?php 
                        if($row["visible_prod_m"] == 1){
                            echo 'Visible';
                        }else{
                            echo 'Oculto';
                        }
                    ?></td>
                    <td><?php echo $row["tmprepa_prod_m"] ?></td>
                    <td><?php echo $row["descrip_prod_m"] ?></td>
                    <td>
                    <?php 
                            $id_catt = $row["id_cat_prod_menu"];
                            $cons_categoria_sl = "SELECT * FROM categoria_prod_menu WHERE id_cat_prod_menu = '$id_catt'";
                            $res_cons_cat_sl =mysqli_query($conexion, $cons_categoria_sl);

                            while($row3=mysqli_fetch_array($res_cons_cat_sl)){
                                $nombr_cat_m_sl = $row3['nombre_cat'];
                                echo $nombr_cat_m_sl; //mostrar la categoria
                            }
                        ?>
                    </td>
                    <td> 
                        <a class="btn btn-outline-warning m-1" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_producto_m"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/pencil-square.svg" alt="">
                        </a> 
                        <a class="btn btn-outline-danger m-1" href="" data-bs-toggle="modal" data-bs-target="#modal_eliminar<?php echo $row["id_producto_m"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-inline" src="img/trash.svg" alt="">
                        </a> 
                    </td>
                </tr>

                <?php 
                    include("inv-alm-producto-eliminar.php"); 
                    include("inv-alm-producto-edit.php"); 
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal agregar-->
<div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Extras de productos menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="inv-alm-producto-nuevo.php" method="post" enctype="multipart/form-data" id="form-cat">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label" name="nombre">Nombre producto:</label>
                        <input class="form-control" type="text" name="nombre" >
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Precio:</label>
                        <input class="form-control" type="number" name="precio" id="preciopr" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">estado:</label>
                        <select class="form-select" aria-label="Default select example" name="estado">
                            <option value="1" selected>Activo</option>
                            <option value="0">Deshabilitado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Visible:</label>
                        <select class="form-select" aria-label="Default select example" name="visible">
                            <option value="1" selected>Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Tiempo Preparacion:</label>
                        <input class="form-control" type="text" name="tprepa" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Descripcion:</label>
                        <input class="form-control" type="text" name="descripcion" >
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label" name="descripcion">Categoria:</label>
                        <select class="form-select" aria-label="Default select example" name="categoria">
                            <?php 
                                $cons_categoria = "SELECT * FROM categoria_prod_menu ORDER BY id_cat_prod_menu";
                                $res_cons_cat =mysqli_query($conexion, $cons_categoria);

                                while($row=mysqli_fetch_array($res_cons_cat)){
                                    $id_cat_m = $row['id_cat_prod_menu'];
                                    $nombr_cat_m = $row['nombre_cat'];
                            ?>
                            <option value="<?php echo $id_cat_m; ?>"><?php echo $nombr_cat_m;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formFileLg" class="form-label">Imagen de producto:</label>
                        <input class="form-control" id="formFileLg" type="file" name="foto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="btnagregar" value="Agregar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->
    <script>
        new CampoNumerico('#costopr');
        new CampoNumerico('#preciopr');
        new CampoNumerico('#costoex');
        new CampoNumerico('#precioex');
    </script>
    <?php include("includes/footer.php"); ?>
