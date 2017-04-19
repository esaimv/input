<?php
  $idtaller = $_POST['idtaller'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  $resultado = mysqli_query($con, "SELECT asistentes.*, taller.* FROM asistentes LEFT JOIN taller ON taller.ID_TALLER = asistentes.ID_TALLER WHERE asistentes.ID_TALLER = ".$idtaller.";");

  $tabla = array();

  while ($row = mysqli_fetch_array($resultado)){
    $nocarnet = $row['NO_CARNET'];
    $nombre = $row['NOMBRE'];
    $apellido_pat = $row['APELLIDO_PAT'];
    $apellido_mat = $row['APELLIDO_MAT'];
    $nombretaller = $row['NOMBRE_TALLER'];

    $tabla[] = array('nocarnet' => $nocarnet, 'nombre' => $nombre, 'apellido_pat' => $apellido_pat, 'apellido_mat' => $apellido_mat, 'nombretaller' => $nombretaller);
  }

  echo json_encode($tabla);
?>
