<?php
  $nocarnet = $_POST['nocarnet'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  $resultado = mysqli_query($con, "SELECT * FROM transacciones WHERE NO_CARNET = ".$nocarnet.";");

  $tabla = array();

  while ($row = mysqli_fetch_array($resultado)) {
    $nocarnet = $row['NO_CARNET'];
    $fecha = $row['FECHA'];
    $abono = $row['ABONO'];

    $tabla[] = array('nocarnet' => $nocarnet, 'fecha' => $fecha, 'abono' => $abono);
  }

  echo json_encode($tabla);
?>
