<?php 
session_start();
$varsesion = $_SESSION['usuario'];

if($varsesion == null || $varsesion = ''){
    echo 'Sin Autorizacion';
    echo $varsesion;
    die();
}
?>

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