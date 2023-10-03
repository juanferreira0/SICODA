<?php
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
        }
    }
} else {
    echo "No se encontraron duplicados.";
}

// Cerrar la conexión
$conexion->close();

?>
