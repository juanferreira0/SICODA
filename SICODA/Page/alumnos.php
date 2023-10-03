<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS/alumnos.css">
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/1.css">
	<title>Alumnos</title>
</head>
<body style="overflow-x: hidden;" >
	<header style="margin-bottom: 50px;display:flex; " >
		<nav style="width:100%;" > 
			<a href="page.php">Inicio</a>
			<a href="justificaciones.php">Justificaciones</a>
			<a href="asistencias.php">Asistencias</a>
		</nav>
		<img src="img/logo.png" >
	</header>

	<h1 style="text-align:center;text-decoration:underline black;opacity:0.9;">TABLA ALUMNOS</h1>

	<script>
		function advertencia(){
			var not=confirm("¿Estas seguro que deseas eliminar?");
			return not;
		}
	</script>	

	<?php
		header("Content-Type: text/html;charset=utf-8");
		include('config.php');
		include('PHP/eliminar_asistencia.php');
		include('PHP/modificar_alumno.php');
		$sqlClientes = ("SELECT *  FROM alumnos  ORDER BY alumnos.curso ASC ");
		$queryData   = mysqli_query($con, $sqlClientes);
		$total_client = mysqli_num_rows($queryData);
		?>

		<a href="PHP/añadir.php" class="btn btn-outline-primary btn-rounded mb-3" style="margin-left:15px;">Añadir Alumno</a>
		<a href="PHP/vaciar.php" onclick="return advertencia()" class="btn btn-outline-danger mb-3" style="margin-left:15px;" >Vaciar Tabla</a>
	<form action="PHP/Importar.php" method="POST" enctype="multipart/form-data" style="margin-left:15px;">
		<input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".csv" required/>
        <label class="btn btn-primary btn-rounded mb-3" for="file-input">
              <span>Importar CSV</span></label>
		<input type="submit" name="enviar" value="Subir Archivo" style="margin-left:25px;" class="btn btn-success btn-rounded mb-3"> 
	</form>

	

	<div class="container">
		<table class="table table-striped table-bordered table-hover  " style="width:95%;"  id="example" >
			<thead Style="background:blue;" >
				<tr>
				<th scope="col">#</th>
				<th scope="col">C.I</th>
				<th scope="col">NOMBRE Y APELLIDO</th>
				<th scope="col">CURSO</th>
				<th scope="col"></th>
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
				<td><?php echo $data['curso'] ?></td>
				<td>
					<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$data['CI']?>" class="btn btn-warning btn-m">✏️</a>
					<a href="alumnos.php?CI=<?=$data['CI']?>" onclick="return advertencia()" class="btn btn-danger">X</a>
				</td>
				</tr>
				
				

					<!-- Modal -->
					<div class="modal fade" id="exampleModal<?=$data['CI']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header d-flex justify-content-between">
							<h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						<form  method="POST">
							<div class="row">
								<div class="col">
									<input type="text" class="form-control mb-4" placeholder="Nombre" name="txtnombre" value=<?=$data['nombre']?> required>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Apellido" name="txtapellido" value=<?=$data['apellido']?> required>
								</div> 
							</div>
							<div class="row">
								<div hidden class="col">
									<input type="text" class="form-control mb-4" placeholder="CI" name="txtci" required>
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="Curso" name="txtcurso" value=<?=$data['curso']?> required>
								</div>
							</div>
							<div class="text-right">
								<a href="alumnos.php" class="btn btn-outline-secondary btn-rounded mt-4">Atras</a>
								<button href="" type="submit" value="OK" name="btnmodificar" class="btn btn-primary btn-rounded mt-4">Modificar Alumno</a>
							</div>
						</form>
						</div>
						</div>
					</div>
					</div>

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