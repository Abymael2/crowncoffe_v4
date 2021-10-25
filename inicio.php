<?php 
    session_start();
    include("db.php");
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null || $varsesion = ''){
        echo 'Sin Autorizacion';
        echo $varsesion;
        die();
    }
?>

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
            <?php 
            if($_SESSION['permiso']== 'Administrador'){
                include 'headerAdmin.php';
            }else{
                include 'headerAux.php';
            }
            
        ?>
        </header>
        <!-- Navigation-->
        <section class="page-section">
            <div class="container">
                <div class="product-item">
                    <div class="product-item-title d-flex">
                        <div class="bg-faded p-5 d-flex ms-auto rounded">
                            <h3 class="section-heading mb-0">
                                <span class="section-heading-upper">Sistema de la Cafeteria Crown Coffee</span>
                                <span class="section-heading-lower">Bienvenido</span>
                            </h3>
                        </div>
                    </div>
                    <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="img/principal.jpeg" style="height: 20vw;"/>
                    <div class="product-item-description d-flex me-auto">
                    </div>
                </div>
            </div>
        </section>

        <div class="container text-primary">
        <div class="row">
            <div class="col-4  p-1">
            <?php 
                        $consmesas = "SELECT COUNT(m.estado) AS suma FROM mesa AS m WHERE m.estado = 0;";
                        $resmesas = mysqli_query($conexion, $consmesas);
                        $rowmesa = mysqli_fetch_assoc($resmesas);
                        $nummesa = $rowmesa["suma"];
                    ?>
                <label for="formGroupExampleInput" class="form-label "><h3>Mesas ocupadas:</h3><h2><p style="text-align: center;"><?php echo $nummesa ?></p></h2></label>
                
            </div>
            <div class="col-4 p-1">
                    <?php 
                        $conorden = "SELECT COUNT(dor.estado_orden ) AS suma FROM detalle_orden AS dor WHERE dor.estado_orden  = 1;";
                        $resorden = mysqli_query($conexion, $conorden);
                        $roworden = mysqli_fetch_assoc($resorden);
                        $numorden = $roworden["suma"];
                    ?>
                <label for="formGroupExampleInput" class="form-label "><h3>Ordenes pendientes:</h3><h2> <p style="text-align: center;"><?php echo $numorden ?></p></h2></label>
               
            </div>
            <div class="col-4 p-1">
                    <?php 
                        
                    ?>
                <label for="formGroupExampleInput" class="form-label "><h3>Ordenes atendidas:</h3><h2> <p style="text-align: center;"><?php  ?></p></h2></label>
               
            </div>
            
        </div>
    </div>
   
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>


<?php
    
?>