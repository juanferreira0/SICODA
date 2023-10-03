<?php
    include('../config.php');
    $vaciar=$conexion->query("delete from alumnos");
    if ($vaciar==true) {
        echo 'Tabla Vaciada Correctamente';
    } else {
        echo 'Error al vaciar';
    }?>

    <script>
    setTimeout(()=>{
        window.history.replaceState(null,null,window.location.pathname);  
    },0);  
    </script>

<a href="../alumnos.php">Atras</a>
