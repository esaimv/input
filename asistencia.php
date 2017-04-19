<?php
  $nocarnet = $_POST['nocarnet'];
  $con = mysqli_connect('localhost', 'root', '', 'input');
  mysqli_query($con, "UPDATE asistencia SET DIA! = 1 WHERE NO_CARNET = ".$nocarnet.";");

  $datos['exito'] = true;
  echo json_encode($datos);
 ?>
