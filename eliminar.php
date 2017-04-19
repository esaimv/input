<?php
  $nocarnet = $_POST['nocarnet'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  $resultado = mysqli_query($con, "DELETE FROM asistentes WHERE asistentes.NO_CARNET = ".$nocarnet.";");

  $datos['exito'] = true;
  echo json_encode($datos); 
?>
