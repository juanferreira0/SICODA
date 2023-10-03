<?php


if (!empty($_POST["btnmodificar"])) {
    $ci=$_POST["txtci"];
    $nombre=$_POST["txtnombre"];
    $apellido=$_POST["txtapellido"];
    $curso=$_POST["txtcurso"];

    $sql=$conexion->query(" select coun(*) as 'total' from alumnos where CI=$ci ");
    if ($sql->fetch_object()->total>0) {
       $modificar="UPDATE alumnos SET  nombre = '$nombre', apellido = '$apellido', curso = '$curso'  WHERE CI = $ci";
       $conexion->query($modificar);
    } else {
        echo "Usuario ya existe";
    }
    
}

?>