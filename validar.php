<html lang="es">
<head>
  <meta charset="utf-8">
</head>

<?php
$usuario = $_POST['nnombre'];
$pass = $_POST['npassword'];

if(empty($usuario) || empty($pass)){
  header("Location: index.html");
  exit();
}

$dbh = mysqli_connect('localhost','root','') or die("Error al conectar " .mysql_error());
mysqli_select_db($dbh, 'input') or die ("Error al seleccionar la Base de datos: " .mysql_error());

$result = mysqli_query($dbh, "SELECT * FROM usuarios WHERE ID_USUARIO='".$usuario."'");

if($row = mysqli_fetch_array($result)){
  $nombre = $row['NOMBRE'];
  $apellidos = $row['APELLIDOS'];
  $admin = $row['ADMIN'];
  if($row['CLAVE'] == $pass){
    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['admin'] = $admin;
    echo "<SCRIPT type='text/javascript'>window.confirm('¡Bienvenido ".$nombre." ".$apellidos."!');</script>";
    echo "<SCRIPT type='text/javascript'>window.document.location='menu.html';</script>";
  }else{
    echo "<SCRIPT type='text/javascript'>window.confirm('¡Usuario o contraseña incorrectos!');</script>";
    echo "<SCRIPT type='text/javascript'>window.document.location='login.html';</script>";
    exit();
  }
}else{
  echo "<SCRIPT type='text/javascript'>window.confirm('¡Usuario o contraseña incorrectos!');</script>";
  echo "<SCRIPT type='text/javascript'>window.document.location='login.html';</script>";
  header("Location: login.html");
  exit();
}
?>
