<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../CSS/alumnos.css">
	<link rel="stylesheet" href="../CSS/bootstrap.min.css">
	<title>Añadir</title>
</head>
<body style="overflow-x: hidden;" >
	<header style="margin-bottom: 50px;display:flex; " >
		<nav style="width:100%;" > 
			<a href="../page.php">Inicio</a>
			<a href="../justificaciones.php">Justificaciones</a>
			<a href="../asistencias.php">Asistencias</a>
            <a href="../alumnos.php">Alumnos</a>
		</nav>
		<img src="../img/logo.png" >
	</header>

    <?php
    $conexion=new mysqli("localhost","root","","login-php","3306");
    include "añadir_alumno.php"
    ?>

<h1 style="text-align:center;text-decoration:underline black;opacity:0.9;">AÑADIR ALUMNO</h1>

    

    <div style="padding:50px;margin: 50px;border-radius:15px;box-shadow:2px 4px 15px black;">
        <form  method="POST">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control mb-4" placeholder="Nombre" name="txtnombre" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Apellido" name="txtapellido" required>
                </div> 
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control mb-4" placeholder="CI" name="txtci" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Curso" name="txtcurso" required>
            </div>
            </div>
            <div class="text-right">
                <a href="../alumnos.php" class="btn btn-outline-secondary btn-rounded mt-4">Atras</a>
                <button href="" type="submit" value="OK" name="btnañadir" class="btn btn-primary btn-rounded mt-4">Añadir Alumno</a>
            </div>
        </form>
    </div>

   
</body>
</html>