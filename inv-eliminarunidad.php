<?php 
    session_start();
    $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }
?>

<?php 
    include("db.php");
?>
<!-- 
  archivos usados
  inv-eliminarunidad
  inv-modaleliminarunidad
-->
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Eliminar Unidades del inventario</title>
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



        
<br>




<!--
    botones de la pagina
-->
              <div class="col">
                
                   <!-- tabla de datos -->
    <div class="container text-primary">
        <!--Buscar y agregar-->
        <div class="row g-3 justify-content">
            <div class="d-grid gap-1 col-3">
                <h2 class="text-light">Productos Inventario</h2>
                   </div>
        </div>
        <table class="table table-striped text-center align-middle" id="datatable"> <!--cta color amarillo-->
            <thead class="cta">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Unidad de medida</th>
                    <th scope="col">Unidades disponibles</th>
                    <th scope="col">Unidades elimindadas</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody class="bg-faded">
                <?php 
                    $categoria = "SELECT * FROM producto_inventario";
                    $resultado = mysqli_query($conexion, $categoria);

                    while($row=mysqli_fetch_assoc($resultado)){
                ?>
                <tr class="">
                    <th scope="row"><?php echo $row["id_producto_inv"] ?></th>
                    <td><?php echo $row["nombre_prod_inv"] ?></td>
                    <td>Q <?php echo $row["costo_prod_inv"] ?></td>
                    <td>
                        <?php 
                            $idd = $row["u_medida_prod_inv"];
                            $cons_uni_med_id = "SELECT * FROM unidad_medida WHERE id_uni_m = '$idd'";
                            $res_cons_uni_id =mysqli_query($conexion, $cons_uni_med_id);
                            while($row1=mysqli_fetch_array($res_cons_uni_id)){
                                $nombr_uni_sel = $row1['nombre_uni'];
                                echo $nombr_uni_sel; //mostrar unidad
                            }
                        ?>
                    </td>
                    <td><?php echo $row["u_disp_prod_inv"]+0 ?></td>
                    <td><?php echo $row["u_elim_prod_inv"]+0 ?></td>
                    <td><?php echo $row["descrip_prod_inv"] ?></td>
                    <td> 
                        <a class="btn btn-outline-danger" href="" data-bs-toggle="modal" data-bs-target="#modal_editar<?php echo $row["id_producto_inv"]; ?>" data-bs-whatever="@mdo">
                            <img class="d-line" src="img/trash.svg" alt="">
                        </a> 
                        
                    </td>
                </tr>

                <?php 
                    include("inv-modaleliminarunidad.php"); 
                    }
                ?>
            </tbody>
        </table>
    </div>

   

    <script type="text/javascript" src="js/validarnumero.js"></script>
    <!-- validacion de input solo numeros -->
    <script>
        new CampoNumerico('#costoin');
        new CampoNumerico('#precioin');
        new CampoNumerico('#udispin');
        new CampoNumerico('#costoex');
        new CampoNumerico('#precioex');
    </script>
    <?php include("includes/footer.php"); ?>

              </div>
              <div class="col">
       
              </div>
            </div>
  
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
