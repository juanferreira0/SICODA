<?php
 

if(!empty($_POST["btnañadir"])){
    $nombre=$_POST["txtnombre"];
    $apellido=$_POST["txtapellido"];
    $CI=$_POST["txtci"];
    $curso=$_POST["txtcurso"];
    
    $sql=$conexion->query("select count(*) as 'total' from alumnos where CI='$CI' ");
    if($sql->fetch_object()->total > 0){
        echo "El Alumno con el CI=$CI ya existe";
    }else {
        $sql_insert=$conexion->query("INSERT INTO alumnos(nombre,apellido,CI,curso)values('$nombre','$apellido','$CI','$curso')");
        echo "Alumno Agregado";
    }
    ?>

    <script>
        setTimeout(()=>{
        window.history.replaceState(null,null,window.location.pathname);  
        },0);  
    </script>
<?php } ?>