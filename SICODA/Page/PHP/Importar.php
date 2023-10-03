<?php
require_once("../config.php");
$ruta = '../Upload/';
$alert = 0;
$x=0;

$cant_doble = 0;

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

            if (!in_array("'", $datos, true)) {

                $sql_insert = "INSERT IGNORE INTO alumnos (CI,nombre,apellido,curso) 
                            VALUES (?, ?, ?, ?)";
                
                $stmt = $con->prepare($sql_insert);
                $stmt->bind_param("ssss", $datos[0], $datos[1], $datos[2], $datos[3]);
                
                if ($stmt->execute()) {
                    echo "Registro insertado correctamente.<br>";
                } else {
                    echo "Error al insertar registro: " . $stmt->error . "<br>";
                }
            
            }else {
                echo "Error: Se encontraron valores nulos en los datos, no se insertará el registro.<br>";
            }
        }
    }
        
    

    
    fclose($fichero);

}



?>

<a href="../alumnos.php">Atras</a>
