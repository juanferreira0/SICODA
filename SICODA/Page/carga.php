<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/carga.css">
</head>
<body>
    <div class="caja">
        
        <h1> SUBIR REPORTE </h1>
        <form action="subir_archivo.php" method="POST" enctype="multipart/form-data">
        <div class="file-input text-center">
            <input  type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".csv" required/>
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Elegir Archivo</span></label
            >
          </div> 
        <input type="submit" name="enviar" value="Subir Archivo" class="boton"> 
        </form>
    </div>
</body>
</html>