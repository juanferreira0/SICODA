<?php

$archivo = 'prueba.csv';

// Leer el archivo CSV y almacenar los datos en un arreglo
$datos = array_map('str_getcsv', file($archivo));

// Agregar "hola" a la última columna de cada fila
foreach ($datos as &$fila) {
    $fila[] = '1';
}

// Abrir el archivo en modo de escritura
$gestor = fopen($archivo, 'w');

// Escribir los datos actualizados en el archivo CSV
foreach ($datos as $fila) {
    fputcsv($gestor, $fila);
}

// Cerrar el archivo
fclose($gestor);

echo "La palabra '1' ha sido insertada en la última columna de todos los registros en $archivo.";

?>
