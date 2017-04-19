<?php
  $nocarnet = $_POST['nocarnet'];
  $nombre = $_POST['nombre'];
  $apellido_pat = $_POST['apellido_pat'];
  $apellido_mat = $_POST['apellido_mat'];
  $escuela = $_POST['escuela'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $talla = $_POST['talla'];
  $carnet = $_POST['carnet'];
  $taller = $_POST['taller'];
  $visita = $_POST['visita'];
  $abono = $_POST['abono'];

  $con = mysqli_connect('localhost', 'root', '', 'input');
  mysqli_query($con, "UPDATE asistentes SET NOMBRE = '".$nombre."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET APELLIDO_PAT = '".$apellido_pat."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET APELLIDO_MAT = '".$apellido_mat."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET ESCUELA = '".$escuela."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET CORREO = '".$correo."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET TELEFONO = '".$telefono."' WHERE NO_CARNET = ".$nocarnet.";");
  mysqli_query($con, "UPDATE asistentes SET ABONO = '".$abono."' WHERE NO_CARNET = ".$nocarnet.";");

  $datos['exito'] = true;
  echo json_encode($datos);
?>
