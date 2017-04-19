<?php
  $nocarnet = $_POST['nocarnet'];
  $fecha = $_POST['fecha'];
  $abono = $_POST['abono'];

  $dbh = mysqli_connect('localhost', 'root', '') or die ("Error al conectar " .mysql_error());
  mysqli_select_db($dbh, 'input');
  mysqli_query($dbh, "INSERT INTO transacciones VALUES(".$nocarnet.",'".$fecha."',".$abono.");");

  $datos['exito'] = true;

  echo json_encode($datos);
 ?>
