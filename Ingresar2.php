<?php

  session_start();
  $rs = mysqli_query($dbh, "SELECT MAX(NO_CARNET) AS NO_CARNET FROM asistentes");
  if ($row = mysqli_fetch_row($rs)) {
    $nocarnet = trim($row[0]); //Guarda en la variable id el ultimo NO_CARNET ingresado
  }

  $idtaller = $_POST['idtaller'];
  $idvisita = $_POST['idvisita'];
  $abono = $_POST['abono'];
  $fecha = $_POST['fecha'];

  $dbh = mysqli_connect('localhost','root','') or die("Error al conectar " .mysql_error());
  mysqli_select_db($dbh, 'input') or die ("Error al seleccionar la Base de datos: " .mysql_error());

  $q = "UPDATE asistentes SET ID_TALLER=".$idtaller.", ID_VISITA=".$idvisita.", ABONO=".$abono." WHERE NO_CARNET=".$nocarnet.";";
  $insertar = mysqli_query($dbh, $q) or die ("Problema con query");
  mysqli_query($dbh, "INSERT INTO transacciones VALUES(".$nocarnet.", '".$fecha."', ".$abono.");");
  mysqli_close($dbh);
  $datos['exito'] = true;

  echo json_encode($datos);

 ?>
