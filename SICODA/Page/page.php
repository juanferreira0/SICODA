<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="CSS/style.css">
  <link rel="stylesheet" href="CSS/bootstrap.min.css">

</head>
<body style="overflow-x: hidden;">
	<header style="margin-bottom: 50px;display:flex;">
		<nav> 
			<a href="asistencias.php">Asistencias</a>
			<a href="justificaciones.php">Justificaciones</a>
			<a href="alumnos.php">Alumnos</a>
		</nav>
		<img src="page_files/logo.png">
	</header>

	<div class="caja">
		<div class="grafico">
		  ñ
		</div>
		
		<div class="Asistencias"> 
			<a href="asistencias.php">Asistieron</a>
			<a href="justificaciones.php">Ausentes</a>

		</div>
	</div>

	
  <h1 style="text-decoration:underline black;opacity:0.9;">ASISTENCIAS RECIENTES</h1>


	<div class="container" style="margin-left:55px;">
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

        <table class="table table-striped table-bordered table-hover" style="width:95%;" >
          <thead>
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
	

   

</body></html>