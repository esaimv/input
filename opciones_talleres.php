<?php

  $dbh = mysqli_connect('localhost','root','') or die("Error al conectar " .mysql_error());
  mysqli_select_db($dbh, 'input') or die ("Error al seleccionar la Base de datos: " .mysql_error());

  $q = "SELECT * FROM taller";

  $resultado = mysqli_query($dbh, $q) or die ("Problema con query");
  mysqli_close($dbh);

  $tabla = array();

  while($row = mysqli_fetch_array($resultado)){
    $idtaller = $row['ID_TALLER'];
    $nombretaller = $row['NOMBRE_TALLER'];

    $tabla[] = array('idtaller' => $idtaller, 'nombretaller' => $nombretaller);
  }

  echo json_encode($tabla);

 ?>
