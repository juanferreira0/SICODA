<?php
require_once("config.php");
$ruta = 'Upload/';
$alert = 0;
$x=0;
$i=0;


foreach ($_FILES as $key) {
    $nombre = $key["name"];
    $ruta_temporal = $key["tmp_name"];
    $fecha = getdate();
    $nombre_v = $fecha["mday"] . "-" . $fecha["mon"] . "-" . $fecha["year"] . "_" . $fecha["hours"] . "-" . $fecha["minutes"] . "-" . $fecha["seconds"] . ".csv";
    $destino = $ruta . $nombre_v;

    if (move_uploaded_file($ruta_temporal, $destino)) {
        $alert = 2;
    }

    
    $fichero = fopen($destino, "r");   
       
        
    while (($datos = fgetcsv($fichero, 1000)) !== FALSE) {
        $x++;
        if ($x > 1) {

            $datos = array_map(function ($value) {
                return str_replace("'", "", $value);
            }, $datos);
        
            $datos = array_map(function ($value) {
                return str_replace("IN", "ENTRADA", $value);
            }, $datos);
            
                

                
            
            //$datadupli=$conexion->query("select count(*) as 'total' from reportes where fecha='$datos[3]' and CI='$datos[1]'  ");

           // if($datadupli->fetch_object()->total < 1){
                if (!in_array("'", $datos, true)) {

                    $sql_insert = "INSERT IGNORE INTO reportes (nombre,CI,card,fecha,hora,en,readid,eventmain,eventsub,attendance,serialNo) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    $stmt = $con->prepare($sql_insert);
                    $stmt->bind_param("sssssssssss", $datos[0], $datos[1], $datos[2], $datos[3], $datos[4],$datos[5], $datos[6], $datos[7], $datos[8], $datos[9],$datos[10]);
                    
                    if ($stmt->execute()) {
                        echo "Registro insertado correctamente.<br>";
                    } else {
                        echo "Error al insertar registro: " . $stmt->error . "<br>";
                    }
                
                }else {
                    echo "Error: Se encontraron valores nulos en los datos, no se insertará el registro.<br>";
                }
           // }
        }
    }
    

    
    fclose($fichero);

}

$conexion=new mysqli("localhost","root","","login-php","3306");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para encontrar duplicados
$sql = "SELECT fecha, COUNT(*) as cantidad FROM reportes GROUP BY fecha HAVING COUNT(*) > 1";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Iterar sobre los resultados
    while($row = $result->fetch_assoc()) {
        $campo_duplicado = $row["fecha"];
        $cantidad = $row["cantidad"];

        // Si hay más de un duplicado, eliminar los registros duplicados excepto el primero y el último
        if ($cantidad > 1) {
            $delete_sql = "DELETE FROM reportes WHERE fecha = '$campo_duplicado' AND a NOT IN (SELECT MIN(a) FROM reportes WHERE fecha = '$campo_duplicado' UNION SELECT MAX(a) FROM reportes WHERE fecha = '$campo_duplicado')";
            
            $conexion->query($delete_sql);
           
            echo "Se eliminaron los registros duplicados.<br>";
        }
    }
} else {
    echo "No se encontraron duplicados.";
}

$sql ="SELECT fecha, MAX(a) as max_id FROM reportes GROUP BY fecha HAVING COUNT(*) > 1";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    // Iterar sobre los resultados
    while($row = $result->fetch_assoc()) {
        $campo_duplicado = $row["fecha"];
        $max_id = $row["max_id"];

        // Actualizar registros duplicados
        $salida="UPDATE reportes SET en = 'SALIDA' WHERE en = 'ENTRADA' AND a = $max_id";
        $conexion->query($salida);
        echo "Se actualizaron los registros correctamente.<br>";
    }
} else {
    echo "No se encontraron duplicados.";
}

// Cerrar la conexión
$conexion->close();



?>

<a href="page.php">Conrinuar</a>
