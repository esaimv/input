<?php
  if($_POST['opcion'] == "buscar"){
    $errores = array();
    $datos = array();

    if(empty($_POST['nocarnet'])){
      $errores['nocarnet'] = "Debes ingresar numero de carnet";
    }else{
      $nocarnet = $_POST['nocarnet'];
    }

    if(empty($errores)){
      $con = mysqli_connect('localhost', 'root', '', 'input');
      $resultado = mysqli_query($con, "SELECT asistentes.*, carnet.*, taller.*, visitas.* FROM taller LEFT JOIN asistentes ON asistentes.ID_TALLER = taller.ID_TALLER LEFT JOIN visitas ON asistentes.ID_VISITA = visitas.ID_VISITA LEFT JOIN carnet ON asistentes.ID_CARNET = carnet.ID_CARNET WHERE asistentes.NO_CARNET=".$nocarnet.";");

      $datos['exito'] = true;
      $datos['consulta'] = mysqli_fetch_array($resultado);
    }else{
      $datos['exito'] = false;
      $datos['errores'] = $errores;
    }

    echo json_encode($datos);

  }else{
    if($_POST['opcion'] == "actualizar"){
      $errores = array();
      $datos = array();
      $nocarnet = $_POST['nocarnet'];

      if(empty($_POST['abono'])){
        $errores['abono'] = "Debes ingresar abono";
      }else{
        $abono = $_POST['abono'];
      }
    }

    if(empty($errores)){
      $con = mysqli_connect('localhost', 'root', '', 'input');
      $resultado = mysqli_query($con, "UPDATE asistentes SET PAGO = ".$abono." WHERE NO_CARNET = ".$nocarnet.";");

      $datos['exito'] = true;
    }else{
      $datos['exito'] = false;
      $datos['errores'] = $errores;
    }

    echo json_encode($datos);
  }
?>
