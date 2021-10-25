<?php 
    session_start();
    $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }

    include("db.php");
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Toma de ordenes</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/estiloposicion.css">
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

        <!-- alerta de agregar mesa -->
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

        <div class="container p-5">
            <div class="row row-cols-md-5 g-4 ">
                
                <a href="#modal_agregar" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#modal_agregar">Crear</a>
                <a href="#modal_agregar" class="btn btn-outline-danger m-2" data-bs-toggle="modal" data-bs-target="#modal_eliminar">Eliminar</a>
                
            </div>

            <div class="row row-cols-1 row-cols-md-5 g-4">
                <?php 
                    $mesa = "SELECT * FROM mesa ORDER BY numero";
                    $resultado = mysqli_query($conexion,$mesa);

                    while($row=mysqli_fetch_assoc($resultado)){
                        if($row["estado"] > 0){
                            $estado = "Activo";
                            $color = "primary";
                            $borde = "light";
                            $btn = "";
                        }
                        else{
                            $estado = "Ocupado";
                            $color = "light";
                            $borde = "primary";
                            $btn = "disabled";
                        }
                        $num_mesa = $row["numero"];
                ?>
                <div class="col">
                    <div class="card text-center text-secondary bg-<?php echo $color ?> border border-<?php echo $borde ?> border-5">
                    <!-- <form action="toma_orden_prod.php" method="post"> -->
                    <form action="toma_orden_prod.php?id=<?php echo $row["numero"] ?>" method="post" id="form-cat">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["nombre_mesa"]," ",$row["numero"] ?></h5>
                            <img src="img/res.png" class="" alt="..." style="height: 14vh;">
                            <p class="card-text"><?php echo $estado ?></p>
                            <input class="btn btn-secondary btn-lg btn-block" type="submit"  name="btnaa" value="Ordenar" <?php echo $btn ?>>
                            <br>
                    </div>
                        
                    </form>
                    </div>
                </div>
                <?php 
                    }
                ?>

                
            </div>
        </div>



        <!-- Modal agregar-->
        <div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Agregar nueva mesa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="toma_orden_mesa_nueva.php" method="post" enctype="multipart/form-data" id="form-cat">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" name="num">Numero de la nueva mesa:</label>
                                <input class="form-control" type="number" name="numero" pattern="\d+" step="1" min="1">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <input type="submit" class="btn btn-primary" name="btnagregar" value="Crear">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<!-- Ventana modal para eliminar -->
<div class="modal fade text-dark" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar Mesa</h4>
            </div>

            <div class="modal-body">
            <form action="toma_orden_mesa_eliminar.php" method="post" enctype="multipart/form-data" id="form-cat">
                    <label for="message-text" class="col-form-label" name="descripcion">Seleccione el numero de mesa:</label>
                    <select class="form-select" aria-label="Default select example" name="no_mesa">
                    <option value="0" selected>---</option>
                    <?php 
                        $mesa = "SELECT * FROM mesa";
                        $resultado = mysqli_query($conexion,$mesa);

                        while($row=mysqli_fetch_assoc($resultado)){
                            if($row["estado"] > 0){
                                $numero = $row["numero"];
                    ?>
                    <option value="<?php echo $numero; ?>"><?php echo $numero;?></option>
                    <?php 
                            }
                        }
                    ?>
                    </select>
                    <p><b>Nota:</b> Las mesas ocupadas no se pueden eliminar.</p>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary" name="btneliminar" value="Eliminar">
                </div>
            </form>
                
            </div>
        </div>
    </div>
</div>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
