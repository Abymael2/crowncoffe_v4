<?php 
    session_start();
    error_reporting(0);
    $varsesion = $_SESSION['usuario'];

    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }elseif($_SESSION['caja'] == 1){
        header("Location: inicio.php");
        die();
    }
    include("db.php");
    $gastos = "SELECT * FROM tbcajaefectivo"


?>
<!-- archivos usados
caja efectivo.php
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Abrir caja</title>
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
       
        <section class="page-section clearfix">
            <div class="container">
          



            </div>
        </section>


        <center>  
        <div class="d-grid gap-1 col-3">    
           
            <form action="cajaefectivo.php" method="post" accept-charset="utf-8" >
                <label for="formGroupExampleInput2" class="form-label text-white">Efectivo Inicial</label>
                <br>
                <input type="text" class="form-control" name="txtefectivo">
                <br>
                
                <input class="btn btn-outline-primary btn-md" type="submit" name="btnefectivo" value="Aperturar Caja">
            </form>
            <button type="button" class="btn btn-outline-primary btn-md">Cancelar</button>
                <button type="button" class="btn btn-outline-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal_agregar"> <i class='bx bx-plus-medical'></i> Reanudar Caja </button>
        </div>
   <!-- Modal -->
   <div class="modal fade" id="modal_agregar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reanudar Caja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="mb-3">
                <form action="reanudar-caja.php" method="post" id="form-cat">
                        <label for="message-text" class="col-form-label" name="descripcion">Seleccione la Caja a Aperturar:</label>
                        <select class="form-select" aria-label="Default select example" name="caja">
                            <?php 
                                $cons = "SELECT * FROM tbcajaefectivo";
                                $res =mysqli_query($conexion, $cons);

                                while($row=mysqli_fetch_array($res)){
                                    $id = $row['id'];
                                    $cajacerradas = $row['fecha'];
                                    $abierto = $row['hora_apertura'];
                                    $cerrado = $row['hora_cierre'];
                            ?>
                            <option value="<?php echo $id; ?>"><?php echo 'Fecha: ',$cajacerradas,' Inicio: ', $abierto,' Fin: ',$cerrado;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" class="btn btn-primary" name="reanudar" value="Reanudar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </center>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/form.js"> </script>
    </body>
</html>