<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS/styleattendance.css">
	<link rel="stylesheet" href="CSS/alumnos.css">
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/1.css">
	<title>Asistencias</title>

</head>
<body>
	<header style="margin-bottom: 50px;display:flex;">
		<nav> 
			<a href="page.php">Inicio</a>
			<a href="justificaciones.php">Justificaciones</a>
			<a href="alumnos.php">Alumnos</a>
		</nav>
		<img src="img/logo.png">
	</header>
	
	<h1 style="text-align:center;text-decoration:underline black;opacity:0.9;">TABLA ASISTENCIA</h1>

	<script>
		function advertencia(){
			var not=confirm("¿Estas seguro que deseas eliminar?");
			return not;
		}
	</script>	


	<a href="PHP/vaciar.php" onclick="return advertencia()" class="btn btn-outline-danger mb-3" style="margin-left:15px;" >Vaciar Tabla</a>

	<div class="container" style="margin-left:25px;">
	<?php
	header("Content-Type: text/html;charset=utf-8");
	include('config.php');
	$sql = ("SELECT 
		reportes.nombre,
		reportes.CI,
		reportes.card,
		reportes.fecha,
		reportes.hora,
		reportes.en,
		reportes.readid,
		reportes.eventmain,
		reportes.eventsub,
		reportes.attendance,
		reportes.serialNo,
		alumnos.CI,
		alumnos.nombre,	
		alumnos.apellido,	
		alumnos.curso	
		FROM reportes 
		INNER JOIN alumnos ON reportes.CI = alumnos.CI 
		ORDER BY reportes.fecha DESC
		limit 0,10");
	$queryData   = mysqli_query($con, $sql);
	?>

			<table class="table table-striped table-bordered table-hover" style="width:95%;" id="example">
			<thead Style="background:blue;">
				<tr>
				<th scope="col">#</th>
				<th scope="col">C.I</th>
				<th scope="col">NOMBRE Y APELLIDO</th>
				<th scope="col">FECHA</th>
				<th scope="col">HORA</th>
				<th scope="col">TIPO</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
				
				while ($data = mysqli_fetch_array($queryData)) { ?>
				<tr>
				<th ><?php echo $i++; ?></th>
				<td><?php echo $data['CI']; ?></td>
				<td><?php echo $data['nombre'] ." ".  $data['apellido']; ?></td>
				<td><?php echo $data['fecha'] ?></td>
				<td><?php echo $data['hora'] ?></td>
				<td><?php echo $data['en'] ?></td>
				</tr>
			<?php }?>
			</tbody>
			</table>

		</div>

	<script src="JS/1.js"></script>
	<script src="JS/2.js"></script>
	<script src="JS/bootstrap.min.js"></script>
		<script>
			setTimeout(()=>{
				window.history.replaceState(null,null,window.location.pathname);  
			},0);  
			$(document).ready(function() {
				$('#example').DataTable( {
				"language": {
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
				"zeroRecords": "No se encontró nada - lo sentimos",
				"info": "Mostrar pagina _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros disponibles",
				"infoFiltered": "(Filtrado de _MAX_ registros totales)",
				"search":"Buscar",
				"paginate":{
					"next":"Siguiente",
					"previous":"Anterior"
				}
        }
    } );
} );
		</script>


</body>
</html>