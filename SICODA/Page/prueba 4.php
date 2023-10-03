<?php
$conexion=new mysqli("localhost","root","","login-php","3306");

// Verificar la conexión

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para encontrar duplicados
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
    }
} else {
    echo "No se encontraron duplicados.";
}

// Cerrar la conexión
$conexion->close();

?>
