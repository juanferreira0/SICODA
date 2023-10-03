<?php
if (!empty($_GET["CI"])){
    $CI=$_GET["CI"];
    $sql=$conexion->query("delete from alumnos where CI=$CI");
    if ($sql==true) {
        echo 'Alumno eliminado correctamente';
    } else {
        echo 'Error al eliminar';
    }?>
<script>
  setTimeout(()=>{
    window.history.replaceState(null,null,window.location.pathname);  
  },0);  
</script>
<?php } ?>

