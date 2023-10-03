<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" >
	<title>Login</title>
</head>
<body>
	<div class="caja">
		<aside class="left" > 
			<img src="img/lector.jpg">
		</aside>
		<img class="colegio" src="img/logo.png">
		<h1>Iniciar Sesión</h1>
		<form action="" method="post" >
			<?php
				include "autenticacion.php";
				include "conexion.php";
			?>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" id="nombre" placeholder="Ingresar Nombre" required /><br>
			<label>Contraseña</label>
			<input type="password" name="contraseña" class="contraseña" id="contraseña"  placeholder="Ingresar Contraseña" required /><br>
			<input type="submit"	name="btningresar"  class=boton value="Iniciar Sesion" style="width: auto;">
		</form>
		
	</div>

</body>
</html>