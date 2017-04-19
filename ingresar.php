<?php

  session_start();

  $nombre = $_POST['nombre'];
  $apellido_pat = $_POST['apellido_pat'];
  $apellido_mat = $_POST['apellido_mat'];
  $escuela = $_POST['escuela'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $talla = $_POST['talla'];
  $carnets = $_POST['carnets'];

  $dbh = mysqli_connect('localhost','root','') or die("Error al conectar " .mysql_error());
  mysqli_select_db($dbh, 'input') or die ("Error al seleccionar la Base de datos: " .mysql_error());

  $q = "INSERT INTO asistentes VALUES (NULL, '".$nombre."', '".$apellido_pat."', '".$apellido_mat."', '".$escuela."', '".$correo."', '".$telefono."', '".$talla."', '".$carnets."', '30', '10', '0', '', '', '".$_SESSION['usuario']."', '2016-10-13');";

  $insertar = mysqli_query($dbh, $q) or die ("Problema con query");
  mysqli_close($dbh);

  $datos['carnet'] =$carnets;
  $datos['exito']=true;
  echo json_encode($datos);

 ?>
