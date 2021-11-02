<?php
        session_start();
        include("db.php");
    
        $_SESSION['inv_aumento_resultado'] = $_POST["str"];
        $_SESSION['bd_id_producto_inv'] = $_POST["id_producto_inv"];

        echo "<br>**********<br>";
        echo " resultado sumatoria = ".$_SESSION['inv_aumento_resultado'];
        echo "<br>**********<br>";
    
?>

<script>
    alert(<?php echo " resultado sumatoria = ".$_SESSION['inv_aumento_resultado'];?>);
</script>