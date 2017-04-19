<?php
  session_start();
  if($_SESSION==null){
    $usuario['nombre'] = "Invalido";
  }else{
    $usuario['nombre'] = $_SESSION['nombre'];
    $usuario['admin'] = $_SESSION['admin'];
  }
  echo json_encode($usuario);
?>
