<?php
  $idvisita = $_POST['idvisita'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  $resultado = mysqli_query($con, "SELECT asistentes.*, visitas.* FROM asistentes LEFT JOIN visitas ON visitas.ID_VISITA = asistentes.ID_VISITA WHERE asistentes.ID_VISITA = ".$idvisita.";");

  $tabla = array();

  while ($row = mysqli_fetch_array($resultado)){
    $nocarnet = $row['NO_CARNET'];
    $nombre = $row['NOMBRE'];
    $apellido_pat = $row['APELLIDO_PAT'];
    $apellido_mat = $row['APELLIDO_MAT'];
    $nombrevisita = $row['NOMBRE_VISITA'];

    $tabla[] = array('nocarnet' => $nocarnet, 'nombre' => $nombre, 'apellido_pat' => $apellido_pat, 'apellido_mat' => $apellido_mat, 'nombrevisita' => $nombrevisita);
  }

  echo json_encode($tabla);

?>
