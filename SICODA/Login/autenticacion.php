<?php

include "conexion.php";
if(!empty($_POST["btningresar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["contraseña"]) ) {
      $nombre=$_POST["nombre"];
      $contraseña=$_POST["contraseña"];
      $sql=$conexion->query(" SELECT * FROM cuentas WHERE nombre='$nombre' and contraseña='$contraseña'");
      if ($sql->fetch_object()) {
        header("location:../Page/carga.php");
      } 
    }
}