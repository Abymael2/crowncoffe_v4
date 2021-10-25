<?php
    session_start();
    include("db.php");
    $id_det_orden = $_GET['id_det_orden'];
    $_SESSION['id_det_orden'] = $_GET['id_det_orden'];
    echo $id_det_orden;

    //Tabla detalle de orden
    $consDetOrd = "SELECT m.numero
                FROM detalle_orden AS dto
                INNER JOIN mesa AS m ON dto.id_mesa = m.id_mesa
                WHERE dto.id_det_orden = '$id_det_orden'";
    $resDetOrd = mysqli_query($conexion, $consDetOrd);
    while($rowDetOrd=mysqli_fetch_assoc($resDetOrd)){
        $no_mesa = $rowDetOrd['numero'];
    }


?>

<!-- encabezado de pagina -->
<?php include("includes/header.php"); ?>

<header>
    <h1 class="site text-center text-faded d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">Cafeteria</span>
        <span class="site-heading-lower">Crown Coffee ver</span>
    </h1>
</header>

<div class="container">
    

    <nav class="navbar sticky-top bg-secondary navbar-expand-lg navbar-dark py-lg-4"> 
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                    Mesa No. 
                    <?php 
                        echo $no_mesa;
                    ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown m-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categoria
                </a>
                <ul class="dropdown-menu dropdown-menu-primary" aria-labelledby="navbarDarkDropdownMenuLink">
                    <li><a class="dropdown-item"id="cat_todo" onclick="v_busc_categoria('todo','<?php echo $id_det_orden;?>','<?php echo $no_mesa;?>');">Todo</a></li>
                    <?php 
                        $cons_categoria = "SELECT * FROM categoria_prod_menu ORDER BY id_cat_prod_menu";
                        $res_cons_cat =mysqli_query($conexion, $cons_categoria);

                        while($row=mysqli_fetch_array($res_cons_cat)){
                            $id_cat_m = $row['id_cat_prod_menu'];
                            $nombr_cat_m = $row['nombre_cat'];
                    ?>
                    <!-- <option value="<?php //echo $id_cat_m; ?>"><?php //echo $nombr_cat_m;?></option> -->
                    <!-- <li><a class="dropdown-item" href="toma_orden_prod.php?texto=<?php //echo $nombr_cat_m;?>"><?php //echo $nombr_cat_m;?></a></li> -->
                    <li><a class="dropdown-item" onclick="v_busc_categoria('<?php echo $nombr_cat_m;?>','<?php echo $id_det_orden;?>','<?php echo $no_mesa;?>');" ><?php echo $nombr_cat_m;?></a></li>
                    <?php
                        }
                    ?>
                    
                </ul>
                </li >
                <li class="m-2">
                    <div class=""><a class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#modal_cart_v" data-bs-whatever="@mdo">Lista de productos solicitados</a></div>
                </li>
                <li class="m-2">
                <a type="button" class="btn btn-outline-primary" href="v_toma_orden_elim.php">Cerrar Toma de orden</a>
                </li>
                <li class="m-2">
                    <a class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#modal_calc" data-bs-whatever="@mdo">Calculadora</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <?php include("toma_orden_calculadora.php");?>



<!-- listar productos por categoria -->
<div class="container" id="mostrar_mensaje"></div>


<script>
    // seleccionar categoria "Todo"
    $(document).ready(function(){
      // despues del código
        $('#cat_todo').click();
});

// Funcion para buscar por categoria
	function v_busc_categoria(catp, id_det_ord, nomesa)
    { 
        var parametros = 
        {
            "nombre" : catp,
            "id_det_ord" : id_det_ord,
            "nomesa" : nomesa
        };

        $.ajax({
            data: parametros,
            url: 'v_toma_orden_list_prod.php',
            type: 'POST',
            
            beforesend: function()
            {
            $('#mostrar_mensaje').html("Mensaje antes de Enviar");
            },

            success: function(mensaje)
            {
            $('#mostrar_mensaje').html(mensaje);
            }
        });
    }
</script>

<script type="text/javascript" src="js\calculadora.js"></script>
<?php include("includes/footer.php"); ?>
