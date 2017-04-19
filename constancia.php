<?php
  $nocarnet = $_POST['nocarnet'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  $resultado = mysqli_query($con, "SELECT * FROM asistentes WHERE NO_CARNET = ".$nocarnet.";");

  $datos = mysqli_fetch_array($resultado);

  echo json_encode($datos);
?>
