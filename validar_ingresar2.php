<html>
  <head>
    <title>Ingresar</title>
    <link href="css/style.css" rel="stylesheet">
  </head>
  <br><br>
</html>

<?php
  //Quitar errores enfadosos de php
  error_reporting(E_ALL ^ E_NOTICE);
  session_start(); // Inicia la sesion
  $carnet = $_SESSION['carnet']; // Guarda el valor de carnet, de la sesion
  //Comienza a crear el form del HTML
  echo "<center><form method='post' action='validar_ingresar2.php'>";
  // Pregunta si el carnet, es de los que incluyen visita
  if($carnet == 51 || $carnet == 53 || $carnet == 54 || $carnet == 56 || $carnet == 57 || $carnet == 59 ){
    //Conecta y consulta la base de datos, en la tabla visitas
    $dbh = mysqli_connect('localhost', 'root', '') or die ("Error al conectar " .mysql_error());
    mysqli_select_db($dbh, 'input');
    $resultado = mysqli_query($dbh, "SELECT * FROM visitas");
    //Comienza a crear un form en HTML donde se desplegara un combobox de las visistas
    echo "<label> Visita: </label><br>";
    echo "<select name= visita><option selected>Elige una opcion</option>";
    //Inserta uno por uno los nombres de las visistas en el combobox
    $c= 10;
    while($renglon = mysqli_fetch_array($resultado))
    {
      echo "<option value='".$c."'>".$renglon[1]."</option>";//inserta el campo nombre, en el combobox
      $c++; // incrementa c para usarlo como el valor del combobox
    };
    echo "</select><br>";//Termina el combobox
  };
  //Pregunta si el carnet, incluye taller
  if($carnet == 52 || $carnet == 53 || $carnet == 55 || $carnet == 56 || $carnet == 58 || $carnet == 59 ){
    //Conecta y consulta la base de datos, en la tabla taller
    $dbh = mysqli_connect('localhost', 'root', '') or die ("Error al conectar " .mysql_error());
    mysqli_select_db($dbh, 'input');
    $resultado = mysqli_query($dbh, "SELECT * FROM taller");
    //Comienza a crear un form en HTML donde se desplegara un combobox de los talleres
    echo "<label> Taller: </label><br>";
    echo "<select name= taller><option selected>Elige una opcion</option>";
    //Inserta uno por uno los nombres de los talleres en el combobox
    $c=30; //Contador inicia en 30, valor de ningun taller
    while($renglon = mysqli_fetch_array($resultado))
    {
      echo "<option value='".$c."'>".$renglon[1]."</option>";//inserta el campo nombre, en el combobox
      $c++;// incrementa c para usarlo como el valor del combobox
    };
    echo "</select><br>";//Termina el combobox
  };

  //Consulta la base de dato para obtener el precio del carnet y meterlo en una variable
  $rs = mysqli_query($dbh, "SELECT PRECIO FROM carnet WHERE (ID_CARNET=".$carnet.");");
  if($row = mysqli_fetch_row($rs)){
    $precio = trim($row[0]);
  };

  echo "<br>";
  echo "<label>Costo total del carnet:  ".$precio."$</label><br>";//Imprime el precio del carnet
  echo "<input type='text' name='pago' id='pago' placeholder='Pago / Abono' required><br><br>";
  echo "<input type='submit' name='Confirmar' value='Confirmar'>";//Boton
  echo "</form></center>";// Termina el form

  //Si se hizo click en el boton confirmar
  if($_POST['Confirmar'] == 'Confirmar') {
    //Busca el ultimo registro insertado
    $rs = mysqli_query($dbh, "SELECT MAX(NO_CARNET) AS NO_CARNET FROM asistentes");
    if ($row = mysqli_fetch_row($rs)) {
      $id = trim($row[0]); //Guarda en la variable id el ultimo NO_CARNET ingresado
    }

    $taller = $_POST['taller']; // Obtiene el valor del taller seleccionado
    $visita = $_POST['visita']; //Obtiene el valor de la visista seleccionada
    $pago = $_POST['pago']; //Obitne el pago

    //Si tiene taller
    if($carnet == 52 || $carnet == 53 || $carnet == 55 || $carnet == 56 || $carnet == 58 || $carnet == 59){
      //Update a la base de datos para ingresar el taller
      $resultado = mysqli_query($dbh, "UPDATE asistentes SET ID_TALLER ='".$taller."' WHERE asistentes.NO_CARNET = ".$id.";");
    };

    if($carnet == 51 || $carnet == 53 || $carnet == 54 || $carnet == 56 || $carnet == 57 || $carnet == 59 ){
      //Update a la base de datos para ingresar la visita
      $resultado = mysqli_query($dbh, "UPDATE asistentes SET ID_VISITA ='".$visita."' WHERE asistentes.NO_CARNET = ".$id.";");
    };
    //Update a la base de datos para ingresar el pago o abono
    $resultado = mysqli_query($dbh, "UPDATE asistentes SET PAGO ='".$pago."' WHERE asistentes.NO_CARNET = ".$id.";");
    mysqli_close($dbh);
    //Script alerta de asistente ingresado
    echo "<SCRIPT type='text/javascript'>window.confirm('¡Asistente registrado!');</script>";
    //Script para cerrar la ventana emergente, y cargar la ventana de ingresar en la principal
    echo "<script type='text/javascript'>window.close();window.opener.document.location='menu.html'</script>";

  };

?>
