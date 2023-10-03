<?php
require_once("config.php");
$ruta = 'Upload/';
$alert = 0;
$x = 0;
$a=0;
$datadupli=0;

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

        $datos = array_map('str_getcsv', file($destino));

        // Agregar "hola" a la última columna de cada fila
        foreach ($datos as &$fila) {
            $fila[] = '1';
        }

        // Abrir el archivo en modo de escritura
        $gestor = fopen($destino, 'w');

        // Escribir los datos actualizados en el archivo CSV
        foreach ($datos as $fila) {
            fputcsv($gestor, $fila);
        }

        echo "La palabra '1' ha sido insertada en la última columna de todos los registros en $destino.";


    while (($datos = fgetcsv($fichero, 1000)) !== FALSE) {
        $x++;
        if ($x > 1) {

            $datos = array_map(function ($value) {
                return str_replace("'", "", $value);
            }, $datos);
            if ($a==0) {
                $datos = array_map(function ($value) {
                    return str_replace("IN", "ENTRADA", $value);
                }, $datos);
                $a==1;
            }else {
                $datos = array_map(function ($value) {
                    return str_replace("IN", "SALIDA", $value);
                }, $datos);
                $a==1;
            }
               
            $datadupli = $conexion->query("select count(*) as 'total' from reportes where fecha='$datos[3]' and CI='$datos[1]'  ");


           if ($datadupli->fetch_object()-> total < 1) {
                if (!in_array("'", $datos, true)) {
                        $sql_insert = "INSERT IGNORE INTO reportes (nombre,CI,card,fecha,hora,en,readid,eventmain,eventsub,attendance,serialNo) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                        $stmt = $con->prepare($sql_insert);
                        $stmt->bind_param("sssssssssss", $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10]);

                            if ($stmt->execute()) {
                            
                                echo "Registro insertado correctamente.<br>";
                            } else {
                                echo "Error al insertar registro: " . $stmt->error . "<br>";
                            }
                } else {
                    echo "Error: Se encontraron valores nulos en los datos, no se insertará el registro.<br>";
                }
            } else {
                $datadupli = $conexion->query("select count(*) as 'total' from reportes where fecha='$datos[3]' and CI='$datos[1]'  ");

                if ($datadupli->fetch_object()-> total < 2) {
                    
                    $delete= $conexion->query("delete from reportes where a=1 and CI='$datos[1]' ");
                    $sql_insert = "INSERT IGNORE INTO reportes (nombre,CI,card,fecha,hora,en,readid,eventmain,eventsub,attendance,serialNo,a) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                     $stmt = $con->prepare($sql_insert);
                     $stmt->bind_param("ssssssssssss", $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10],$datos[11]);

                    if ($stmt->execute()) {
                        echo "Registro insertado correctamente.<br>";
                    } else {
                            echo "Error al insertar registro: " . $stmt->error . "<br>";
                    }
                }
                    $sql_insert = "INSERT IGNORE INTO reportes (nombre,CI,card,fecha,hora,en,readid,eventmain,eventsub,attendance,serialNo,a) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

                            $stmt = $con->prepare($sql_insert);
                            $stmt->bind_param("ssssssssssss", $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], $datos[6], $datos[7], $datos[8], $datos[9], $datos[10],$datos[11]);

                                if ($stmt->execute()) {

                                    echo "Registro insertado correctamente.<br>";
                                } else {
                                    echo "Error al insertar registro: " . $stmt->error . "<br>";
                                }
                        
            }
        }
    }

    fclose($fichero);
}


?>

<a href="page.php">Continuar</a>
